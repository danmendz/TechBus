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
        $cantidadBoletos = Session::get('cantidad_boletos');
        $asientosSeleccionados = Session::get('asientos_seleccionados');
        $preciosBoletos = Session::get('precios_detallados');

        if (!$corridaId || !$usuarioId) {
            throw new \Exception('Faltan datos obligatorios para guardar el ticket.');
        }

        $detallesCompra = [
            'cantidad_boletos' => $cantidadBoletos,
            'asientos' => $asientosSeleccionados,
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