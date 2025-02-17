<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class WhatsappService
{
    /**
     * Envía un mensaje de WhatsApp a un número de teléfono.
     *
     * @param string $phoneNumber Número de teléfono destinatario
     * @return array Respuesta de la API
     * @throws Exception Si ocurre un error en la solicitud
     */
    public function sendMessage($phoneNumber)
    {
        try {
            $token = config('services.whatsapp.whatsapp_tk');
            $phoneId = config('services.whatsapp.whatsapp_phone_id');
            $apiVersion = config('services.whatsapp.whatsapp_version');

            $payload = [
                'messaging_product' => 'whatsapp',
                'to' => $phoneNumber,
                'type' => 'template',
                'template' => [
                    'name' => 'hello_world',
                    'language' => [
                        'code' => 'en_US',
                    ],
                ],
            ];

            $response = Http::withToken($token)
                ->post("https://graph.facebook.com/{$apiVersion}/{$phoneId}/messages", $payload)
                ->throw()
                ->json();

            // Puedes registrar la respuesta si lo deseas
            // \Log::info("Mensaje enviado a {$phoneNumber}: " . json_encode($response));

            return $response;

        } catch (Exception $e) {
            // \Log::error("Error enviando mensaje a {$phoneNumber}: " . $e->getMessage());
            throw new Exception("Error enviando mensaje a {$phoneNumber}: " . $e->getMessage());
        }
    }
}