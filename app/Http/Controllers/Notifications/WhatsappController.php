<?php

namespace App\Http\Controllers\Notifications;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    // public function sendMessage()
    // {
    //     try {
    //         $token = config('services.whatsapp.whatsapp_tk');
    //         $phoneId = '523188307547107';
    //         $version = config('services.whatsapp.whatsapp_version');

    //         $payload = [
    //             'messaging_product' => 'whatsapp',
    //             'to' => '522216075444',
    //             'type' => 'template',
    //             'template' => [
    //                 'name' => 'hello_world',
    //                 'language' => [
    //                     'code' => 'en_US',
    //                 ],
    //             ],
    //         ];

    //         $message = Http::withToken($token)
    //                 ->post('https://graph.facebook.com/'.$version.'/'. $phoneId.'/messages', $payload)
    //                 ->throw()
    //                 ->json();

    //         return response()->json([
    //             'success' => true,
    //             'data' => $message,
    //         ], 200);

    //     } catch (Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'data' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function sendMessages()
    {
        try {
            // Obtener números de teléfono desde la base de datos
            $phoneNumbers = $this->getPhoneNumbersFromDatabase();

            // Enviar mensajes a los números obtenidos
            $results = $this->sendMessagesToPhoneNumbers($phoneNumbers);

            // Retornar el resultado
            return response()->json(
                [
                    'success' => true,
                    'results' => $results,
                ],
                200,
            );
        } catch (Exception $e) {
            // Manejo de errores generales
            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Obtiene los números de teléfono de la base de datos.
     *
     * @return array Lista de números de teléfono
     */
    private function getPhoneNumbersFromDatabase(): array
    {
        // // Consulta la base de datos para obtener números válidos
        // return DB::table('users')
        //     ->select('phone') // Columna que contiene los números de teléfono
        //     ->whereNotNull('phone') // Evitar teléfonos nulos
        //     ->pluck('phone') // Obtener solo los valores de la columna 'phone'
        //     ->toArray();

        // Array de números de teléfono aleatorios para pruebas
        return [
            '522216075444',
        ];
    }

    /**
     * Envía un mensaje a una lista de números de teléfono.
     *
     * @param array $phoneNumbers Lista de números de teléfono
     * @return array Resultados de los envíos
     */
    private function sendMessagesToPhoneNumbers(array $phoneNumbers): array
    {
        $results = [];
        $token = $this->getToken();
        $phoneId = $this->getPhoneId();
        $apiVersion = $this->getApiVersion();

        foreach ($phoneNumbers as $phoneNumber) {
            try {
                // Formatear y enviar el mensaje
                $payload = $this->buildMessagePayload($phoneNumber);
                $response = $this->sendMessageToApi($payload, $token, $phoneId, $apiVersion);

                // Registrar el resultado como éxito
                $results[] = [
                    'phone' => $phoneNumber,
                    'status' => 'success',
                    'response' => $response,
                ];
            } catch (Exception $e) {
                // Registrar el error para este número
                $results[] = [
                    'phone' => $phoneNumber,
                    'status' => 'failed',
                    'error' => $e->getMessage(),
                ];
            }
        }

        return $results;
    }

    /**
     * Construye el payload del mensaje para la API.
     *
     * @param string $phoneNumber Número de teléfono destinatario
     * @return array Payload del mensaje
     */
    private function buildMessagePayload(string $phoneNumber): array
    {
        return [
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
    }

    /**
     * Envía el mensaje a la API de WhatsApp.
     *
     * @param array $payload Cuerpo del mensaje
     * @param string $token Token de acceso a la API
     * @param string $phoneId ID del teléfono en la API
     * @param string $apiVersion Versión de la API
     * @return array Respuesta de la API
     * @throws Exception Si ocurre un error en la solicitud
     */
    private function sendMessageToApi(array $payload, string $token, string $phoneId, string $apiVersion): array
    {
        return Http::withToken($token)
            ->post("https://graph.facebook.com/{$apiVersion}/{$phoneId}/messages", $payload)
            ->throw()
            ->json();
    }

    /**
     * Obtiene el token de acceso para la API de WhatsApp.
     *
     * @return string Token de acceso
     */
    private function getToken(): string
    {
        return config('services.whatsapp.whatsapp_tk');
    }

    /**
     * Obtiene el ID del teléfono configurado en la API de WhatsApp.
     *
     * @return string ID del teléfono
     */
    private function getPhoneId(): string
    {
        return config('services.whatsapp.whatsapp_phone_id');
    }

    /**
     * Obtiene la versión de la API de WhatsApp.
     *
     * @return string Versión de la API
     */
    private function getApiVersion(): string
    {
        return config('services.whatsapp.whatsapp_version');
    }
}
