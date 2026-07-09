<?php
namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TicketService
{
    public function saveTicket()
    {
		$codigoReferencia = $this->generateInternalReference();
        $usuarioId = Auth::user()->id;
        $corridaId = Session::get('corrida_id');
        $detallesCorrida = Session::get('corrida_details');
        $resumenBoletos = Session::get('resumen_boletos');
        $preciosBoletos = Session::get('precios_detallados');

        if (!$corridaId || !$usuarioId || !$preciosBoletos) {
            throw new \Exception('Faltan datos obligatorios para guardar el ticket.');
        }

        $detallesCompra = [
            'detalles_corrida' => $detallesCorrida,
            'resumen_boletos' => $resumenBoletos,
            'precios' => $preciosBoletos,
        ];

        $ticket = Ticket::create([
            'id_corrida' => $corridaId,
            'id_usuario' => $usuarioId,
			'codigo_referencia' => $codigoReferencia,
            'detalles_compra' => json_encode($detallesCompra),
        ]);

        return $ticket;
    }

	public function generateInternalReference()
	{
		return 'PAY-' . strtoupper(uniqid());
	}
}