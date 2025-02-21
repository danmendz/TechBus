<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class WhatsappService
{
    protected $apiUrl;
    protected $token;
    protected $phoneId;

    public function __construct()
    {
        $this->apiUrl = config('services.whatsapp.whatsapp_version');
        $this->token = config('services.whatsapp.whatsapp_tk');
        $this->phoneId = config('services.whatsapp.whatsapp_phone_id');
    }

    /**
     * Envía un mensaje de WhatsApp utilizando una plantilla de Meta
     *
     * @param string $phoneNumber Número de teléfono destinatario
     * @param string $templateName Nombre de la plantilla en Meta
     * @param array $parameters Datos dinámicos para la plantilla
     * @return array Respuesta de la API
     * @throws Exception Si ocurre un error en la solicitud
     */
    public function sendMessage($phoneNumber, $templateName, array $parameters, $image = null, $languageCode = 'es')
    {
        try {
            $components = [];

            // Agregar imagen al header si se proporciona
            if ($image) {
                $components[] = [
                    'type' => 'header',
                    'parameters' => [
                        [
                            'type' => 'image',
                            'image' => ['link' => $image]
                        ]
                    ]
                ];
            }

            // Agregar los parámetros del cuerpo del mensaje
            $bodyParameters = array_map(fn($param) => [
                'type' => 'text',
                'text' => (string) $param
            ], $parameters);

            if (!empty($bodyParameters)) {
                $components[] = [
                    'type' => 'body',
                    'parameters' => $bodyParameters
                ];
            }

            // Construir la solicitud
            $payload = [
                'messaging_product' => 'whatsapp',
                'to' => $phoneNumber,
                'type' => 'template',
                'template' => [
                    'name' => $templateName,
                    'language' => ['code' => $languageCode],
                    'components' => $components
                ]
            ];

            $response = Http::withToken($this->token)
                ->post("https://graph.facebook.com/{$this->apiUrl}/{$this->phoneId}/messages", $payload)
                ->throw()
                ->json();

            return $response;
        } catch (Exception $e) {
            throw new Exception("Error enviando mensaje a {$phoneNumber}: " . $e->getMessage());
        }
    }
}