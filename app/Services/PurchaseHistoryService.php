<?php
namespace App\Services;

use App\Models\PurchaseHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PurchaseHistoryService
{
    public function saveHistory($idPayment, $idTicket)
    {
        $userId = Auth::user()->id;
        $paymentId = $idPayment;
        $ticketId = $idTicket;

        $history= PurchaseHistory::create([
            'id_usuario' => $userId,
            'id_payment' => $paymentId,
            'id_ticket' => $ticketId
        ]);

        return $history;
    }
}