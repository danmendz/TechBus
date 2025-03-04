<?php

namespace App\Livewire;

use App\Mail\NotificationEmail;
use Livewire\Component;
use App\Models\Ubicacion;
use App\Models\FlotaAutobuses;
use App\Models\Horario;
use App\Models\Corrida;
use App\Models\TipoBoleto;
use App\Models\PrecioBoleto;
use App\Models\Asiento;
use App\Models\User;
use App\Services\StripeService;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BusTicketStepper extends Component
{
    // Paso actual del stepper
    public $currentStep = 1;
    protected $whatsappService;
    protected $stripeService;

    // Datos para el Paso 1: Selección de la Corrida
    public $origen;
    public $destino;
    public $horario;
    public $fecha;
    public $corridasDisponibles = [];

    // Datos para el Paso 2: Selección del Número de Boletos
    public $tipoBoleto;
    public $cantidadBoletos = [];
    public $precioTotal = 0;

    // Datos para el Paso 3: Selección de Asientos
    public $asientosDisponibles = [];
    public $asientosSeleccionados = [];
    public $boletoActual = 0; // Índice del boleto que se está seleccionando

    // Datos para el Paso 4: Resumen de la Compra
    public $resumenCorrida;
    public $resumenBoletos = [];
    public $cantidadTotal = 0;
    public $tiposBoletos = [];
    public $resumenAsientos;
    public $corridaSeleccionada;

    public function __construct()
    {
        $this->whatsappService = new WhatsappService();
        $this->stripeService = new StripeService();
    }

    // Método para avanzar al siguiente paso
    public function nextStep()
    {
        if ($this->currentStep == 4) {
            // Generar el resumen de boletos y asientos antes de avanzar al paso 5
            $this->generarResumenBoletosYAsientos();
        }
        $this->currentStep++;
    }

    // Método para retroceder al paso anterior
    public function previousStep()
    {
        $this->currentStep--;
    }

    // Método para cargar las corridas disponibles (Paso 1)
    public function loadCorridasDisponibles()
    {
        $query = Corrida::with(['ruta.origen', 'ruta.destino', 'horario'])
            ->whereIn('id_ruta', function ($query) {
                $query->select('id')
                    ->from('rutas')
                    ->where('id_origen', $this->origen)
                    ->where('id_destino', $this->destino)
                    ->where('estatus_corrida', 'programada');
            });

        // Filtrar por fecha si está presente
        if ($this->fecha) {
            $query->whereDate('fecha', $this->fecha);
        }

        // Filtrar por horario si está presente
        if ($this->horario) {
            $query->where('id_horario', $this->horario);
        }

        $this->corridasDisponibles = $query->get();
        $this->nextStep();
    }

    // Método para seleccionar una corrida (Paso 1)
    public function selectCorrida($corridaId)
    {
        $this->corridaSeleccionada = Corrida::find($corridaId);
        $this->resumenCorrida = [
            'origen' => $this->corridaSeleccionada->ruta->origen->nombre,
            'destino' => $this->corridaSeleccionada->ruta->destino->nombre,
            'fecha' => $this->corridaSeleccionada->fecha,
            'hora' => $this->corridaSeleccionada->horario->hora
        ];

        // Cargar los asientos disponibles después de seleccionar la corrida
        $this->loadAsientosDisponibles();

        $this->nextStep();
    }

    // Método para incrementar la cantidad de boletos
    public function incrementarBoleto($tipoBoletoId)
    {
        if (!isset($this->cantidadBoletos[$tipoBoletoId])) {
            $this->cantidadBoletos[$tipoBoletoId] = 0;
        }
        $this->cantidadBoletos[$tipoBoletoId]++;
        $this->calcularPrecioTotal();
    }

    // Método para decrementar la cantidad de boletos
    public function decrementarBoleto($tipoBoletoId)
    {
        if (isset($this->cantidadBoletos[$tipoBoletoId])) {
            if ($this->cantidadBoletos[$tipoBoletoId] > 0) {
                $this->cantidadBoletos[$tipoBoletoId]--;
                $this->calcularPrecioTotal();
            }
        }
    }

    // Método para calcular el precio total
    public function calcularPrecioTotal()
    {
        $this->precioTotal = 0;
        foreach ($this->cantidadBoletos as $tipoBoletoId => $cantidad) {
            $precio = PrecioBoleto::where('id_tipo_boleto', $tipoBoletoId)
                ->first()
                ->precio;
            $this->precioTotal += $precio * $cantidad;
        }
    }

    // Método que se ejecuta cuando se actualiza la cantidad de boletos
    public function updatedCantidadBoletos()
    {
        $this->calcularPrecioTotal();
    }

    // Método para seleccionar un asiento (Paso 3)
    public function selectAsiento($asientoId)
    {
        // Verificar si el asiento ya está seleccionado
        if (in_array($asientoId, $this->asientosSeleccionados)) {
            // Deseleccionar el asiento
            $this->asientosSeleccionados = array_diff($this->asientosSeleccionados, [$asientoId]);
        } else {
            // Verificar que no se exceda la cantidad de boletos comprados
            if (count($this->asientosSeleccionados) < array_sum($this->cantidadBoletos)) {
                $this->asientosSeleccionados[] = $asientoId;

                // Avanzar al siguiente boleto
                $this->boletoActual++;
            } else {
                // Mostrar un mensaje de error o notificación
                session()->flash('error', 'No puedes seleccionar más asientos que la cantidad de boletos comprados.');
            }
        }
    }

    // Método para cargar los asientos disponibles (Paso 3)
    public function loadAsientosDisponibles()
    {
        $this->asientosDisponibles = Asiento::where('id_autobus', function ($query) {
            $query->select('id_autobus')
                ->from('corridas')
                ->where('id', $this->corridaSeleccionada->id);
        })
        ->get()
        ->map(function ($asiento) {
            return [
                'id' => $asiento->id,
                'numero_asiento' => $asiento->numero_asiento,
                'estatus_asiento' => $asiento->estatus_asiento, // 'disponible', 'ocupado', 'silla_ruedas'
            ];
        });
    }

    // Método para generar el resumen de boletos y asientos
    public function generarResumenBoletosYAsientos()
    {
        $this->resumenBoletos = [];
        $this->cantidadTotal = 0; // Inicializar el total de boletos
        $this->tiposBoletos = []; // Lista de tipos de boletos

        // Obtener los tipos de boleto
        $tiposBoleto = TipoBoleto::whereIn('id', array_keys($this->cantidadBoletos))->get();

        // Combinar la información de boletos y asientos
        $index = 0;
        foreach ($this->cantidadBoletos as $tipoBoletoId => $cantidad) {
            $tipoBoleto = $tiposBoleto->firstWhere('id', $tipoBoletoId);

            for ($i = 0; $i < $cantidad; $i++) {
                $asientoId = $this->asientosSeleccionados[$index] ?? null;
                $asiento = $asientoId ? Asiento::find($asientoId) : null;

                $this->resumenBoletos[] = [
                    'tipo_boleto' => $tipoBoleto->tipo,
                    'cantidad' => 1, // Cada boleto es individual
                    'asiento' => $asiento ? $asiento->numero_asiento : 'No asignado',
                ];

                $index++;
            }

            // Sumar la cantidad total de boletos
            $this->cantidadTotal += $cantidad;

            // Guardar el tipo de boleto (evitando duplicados)
            if (!in_array($tipoBoleto->tipo, $this->tiposBoletos)) {
                $this->tiposBoletos[] = $tipoBoleto->tipo;
            }
        }
    }

    //Enviar notificación de whatsapp
    public function sendWhatsappNotification()
    {
        $userName = Auth::user()->name;
        $phoneUser = Auth::user()->phone;

        try {
            $templateName = 'confirmar_compra';
            $languageCode = 'es_MX';

            $parameters = [
                (string) $userName,
                'ADEO.com'
            ];

            $image = 'https://i.postimg.cc/MGMfKfsV/landpage.png';

            $this->whatsappService->sendMessage($phoneUser, $templateName, $parameters, $image, $languageCode);
            session()->flash('message', 'Mensajes enviados correctamente.');

        } catch (\Exception $e) {
            session()->flash('error', "Error enviando mensaje a {$phoneUser}: " . $e->getMessage());
            $this->sendEmailNotification();
        }
    }

    //Enviar notificación de email
    public function sendEmailNotification()
    {
        $user = 'dan@gmail.com';
        $messageBody = "Este es un mensaje de prueba para los usuarios.";

        if (!empty($user)) {
            Mail::to('admin@miempresa.com')
                ->bcc($user)
                ->send(new NotificationEmail('Usuario', $messageBody));
        }
    }

    // Método para confirmar la compra (Paso 4)
    public function confirmarCompra()
    {
        $this->generarResumenBoletosYAsientos();

        $productData = [
            'product_name' => implode(', ', $this->tiposBoletos),
            'quantity' => 1,
            'price' => $this->precioTotal,
        ];

        // Log::info('Datos enviados a StripeService:', $productData);

        $session = $this->stripeService->createCheckoutSession($productData);

        if (isset($session->url)) {
            session([
                'product_name' => $productData['product_name'],
                'quantity' => $productData['quantity'],
                'price' => $productData['price'],
            ]);

            // Log::info('Datos almacenados en la sesión:', session()->all());

            return redirect()->away($session->url);
        } else {
            session()->flash('error', 'Error al procesar el pago.');
        }
    }

    // Renderizar la vista del componente
    public function render()
    {
        return view('livewire.payment.ticket-stepper', [
            'origenes' => Ubicacion::all(),
            'destinos' => Ubicacion::all(),
            'horarios' => Horario::all(),
            'tiposBoleto' => TipoBoleto::all(),
        ]);
    }
}