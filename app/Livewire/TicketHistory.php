<?php

namespace App\Livewire;

use App\Models\Autobus;
use App\Models\Corrida;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Services\QrCodeService;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketHistory extends Component
{
    public $tickets;
    protected $qrCodeService;

    public function __construct()
    {
        $this->qrCodeService = new QrCodeService();
    }

    public function mount()
    {
        $userId = Auth::id();
        
        $this->tickets = Ticket::where('id_usuario', $userId)
                            ->orderBy('created_at', 'desc')
                            ->get();
    }

    public function downloadTicket($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        
        // Buscar la corrida asociada al ticket
        $corrida = $this->findCorrida($ticket->id_corrida);

        // Obtener el autobús asociado a la corrida
        $autobus = $this->getBus($corrida);

        $detalles = json_decode($ticket->detalles_compra, true);
        
        // Preparar datos para el PDF
        $data = [
            'nombrePasajero' => Auth::user()->name,
            'numeroTicket' => $ticket->id,
            'codigoReferencia' => $ticket->codigo_referencia,
            'asientos' => implode(', ', array_map(function($boleto) {
                return $boleto['asiento'];
            }, $detalles['resumen_boletos'])),
            'fecha' => $detalles['detalles_corrida']['fecha'],
            'hora' => $detalles['detalles_corrida']['hora'],
            'autobus' => $autobus->modelo. '-' . $autobus->numero_serie, 
            'origen' => $detalles['detalles_corrida']['origen'],
            'destino' => $detalles['detalles_corrida']['destino'],
            'tiposBoleto' => array_reduce($detalles['resumen_boletos'], function($carry, $item) use ($detalles) {
                $tipo = $item['tipo_boleto'];
                if (!isset($carry[$tipo])) {
                    $carry[$tipo] = [
                        'cantidad' => 0,
                        'precio_unitario' => $detalles['precios'][$tipo]['precio_unitario'],
                        'precio_total' => 0
                    ];
                }
                $carry[$tipo]['cantidad'] += $item['cantidad'];
                $carry[$tipo]['precio_total'] += $detalles['precios'][$tipo]['precio_total'];
                return $carry;
            }, []),
            'metodoPago' => $detalles['metodo_pago'] ?? 'Tarjeta de crédito',
            'precioTotal' => array_sum(array_map(function($boleto) use ($detalles) {
                return $detalles['precios'][$boleto['tipo_boleto']]['precio_total'];
            }, $detalles['resumen_boletos']))
        ];

        // Generar el código QR
        $data['qrCode'] = $this->qrCodeService->generateQrCode($data);

        $pdf = Pdf::loadView('utilities.ticket-pdf', $data);
        
        return response()->streamDownload(
            fn () => print($pdf->output()),
            "ticket-{$ticket->codigo_referencia}.pdf"
        );
    }

    protected function getBus($corrida)
    {
        if ($corrida && $corrida->id_autobus) {
            return Autobus::find($corrida->id_autobus);
        }

        return null;
    }

    protected function findCorrida($idCorrida)
    {
        return Corrida::find($idCorrida);
    }

    public function render()
    {
        return view('livewire.ticket-history');
    }
}