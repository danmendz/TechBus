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

    public function sendNotifications()
    {
        $this->whatsappPurchaseNotification();
        $this->emailPurchaseNotification();
    }

    private function whatsappPurchaseNotification()
    {
        try {
            $userName = Auth::user()->id;
            $phoneUser = Auth::user()->phone;
            $templateName = 'confirmar_compra';
            $languageCode = 'es_MX';

            $parameters = [
                (string) $userName,
                'ADEO.com'
            ];

            $image = 'https://i.postimg.cc/MGMfKfsV/landpage.png';

            $this->whatsappService->sendMessage($phoneUser, $templateName, $parameters, $image, $languageCode);
        } catch (\Exception $e) {
            Log::error("Error enviando mensaje a {$phoneUser}: " . $e->getMessage());
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