<?php
namespace App\Services;

use App\Models\PurchaseHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PurchaseHistoryService
{
    public function saveHistory($idPayment, $idTicket, $idCorrida)
    {
        $userId = Auth::user()->id;
        $paymentId = $idPayment;
        $ticketId = $idTicket;
        $corridaId = $idCorrida;

        $history = PurchaseHistory::create([
            'id_usuario' => $userId,
            'id_corrida' => $corridaId,
            'id_payment' => $paymentId,
            'id_ticket' => $ticketId
        ]);

        return $history;
    }
}