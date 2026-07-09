<?php
namespace App\Services;

use App\Mail\NotificationEmail;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected $whatsappService;

    public function __construct(WhatsappService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function sendNotifications($userName, $userPhone, $notificationData)
    {
        $this->whatsappPurchaseNotification($userName, $userPhone, $notificationData);
    }

    private function whatsappPurchaseNotification($userName, $userPhone, $notificationData)
    {
        $notificationImage = $notificationData->imagen;

        try {
            $templateName = 'confirmacion_compra';
            $languageCode = 'es';

            $parameters = [
                (string) $userName,
                'ADO.com'
            ];

            $image = $notificationImage;

            $this->whatsappService->sendMessage($userPhone, $templateName, $parameters, $image, $languageCode);
        } catch (\Exception $e) {
            Log::error("Error enviando mensaje a {$userPhone}: " . $e->getMessage());
            // $this->emailPurchaseNotification();
        }
    }

    private function emailPurchaseNotification()
    {
        $user = 'dan@gmail.com';
        $messageBody = "Este es un mensaje de prueba para los usuarios.";

        if (!empty($user)) {
            Mail::to('admin@miempresa.com')
                ->bcc($user)
                ->send(new NotificationEmail('Usuario', $messageBody));
        }
    }
}