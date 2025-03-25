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

    public function sendNotifications($userName, $userPhone)
    {
        $this->whatsappPurchaseNotification($userName, $userPhone);
    }

    private function whatsappPurchaseNotification($userName, $userPhone)
    {
        try {
            $templateName = 'confirmacion_compra';
            $languageCode = 'es';

            $parameters = [
                (string) $userName,
                'ADEO.com'
            ];

            $image = 'https://i.postimg.cc/zXT4t3jK/Whats-App-Image-2025-03-17-at-5-09-35-PM.jpg';

            $this->whatsappService->sendMessage($userPhone, $templateName, $parameters, $image, $languageCode);
        } catch (\Exception $e) {
            Log::error("Error enviando mensaje a {$userPhone}: " . $e->getMessage());
            $this->emailPurchaseNotification();
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