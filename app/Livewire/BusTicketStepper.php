<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ubicacion;
use App\Models\FlotaAutobuses;
use App\Models\Horario;
use App\Models\Corrida;
use App\Models\TipoBoleto;
use App\Models\Precio;
use App\Models\Asiento;

class BusTicketStepper extends Component
{
    // Paso actual del stepper
    public $currentStep = 1;

    // Datos para el Paso 1: Selección de la Partida
    public $origen;
    public $destino;
    public $horario;
    public $fecha;
    public $partidasDisponibles = [];

    // Datos para el Paso 2: Selección del Número de Boletos
    public $tipoBoleto;
    public $cantidadBoletos = [];
    public $precioTotal = 0;

    // Datos para el Paso 3: Selección de Asientos
    public $asientosDisponibles = [];
    public $asientosSeleccionados = [];
    public $boletoActual = 0; // Índice del boleto que se está seleccionand

    // Datos para el Paso 4: Resumen de la Compra
    public $resumenPartida;
    public $resumenBoletos = [];
    public $resumenAsientos;
    public $partidaSeleccionada;

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

    // Método para cargar las partidas disponibles (Paso 1)
    public function loadPartidasDisponibles()
    {
        $query = Corrida::with(['ruta.origen', 'ruta.destino', 'horario'])
            ->whereIn('id_ruta', function ($query) {
                $query->select('id')
                    ->from('rutas')
                    ->where('id_origen', $this->origen)
                    ->where('id_destino', $this->destino);
            });

        // Filtrar por fecha si está presente
        if ($this->fecha) {
            $query->whereDate('fecha', $this->fecha);
        }

        // Filtrar por horario si está presente
        if ($this->horario) {
            $query->where('id_horario', $this->horario);
        }

        $this->partidasDisponibles = $query->get();
        $this->nextStep();
    }

    // Método para seleccionar una partida (Paso 1)
    public function selectPartida($partidaId)
    {
        $this->partidaSeleccionada = Corrida::find($partidaId);
        $this->resumenPartida = $this->partidaSeleccionada->fecha . ' - ' . $this->partidaSeleccionada->hora;

        // Cargar los asientos disponibles después de seleccionar la partida
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
            $precio = Precio::where('id_tipo_boleto', $tipoBoletoId)
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
                ->where('id', $this->partidaSeleccionada->id);
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
        }
    }

    // Método para confirmar la compra (Paso 4)
    public function confirmarCompra()
    {
        // Lógica para guardar la compra en la base de datos
        // Redireccionar a una página de confirmación
        return redirect()->route('confirmacion');
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