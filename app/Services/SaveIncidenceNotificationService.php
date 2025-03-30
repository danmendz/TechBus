<?php
namespace App\Services;

use App\Models\NotificationHistory;
use App\Models\PurchaseHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SaveIncidenceNotificationService
{
	public function saveIncidence($IdNotification, $IdCorrida)
	{
		$notificationId = $IdNotification;
		$corridaId = $IdCorrida;

        $incidenceNotification = NotificationHistory::create([
            'id_notificacion' => $notificationId,
            'id_corrida' => $corridaId
        ]);

        return $incidenceNotification;
	}
}