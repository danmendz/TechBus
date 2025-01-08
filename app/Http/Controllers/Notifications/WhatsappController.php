<?php

namespace App\Http\Controllers\Notifications;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    public function sendMessage()
    {
        try {
            $token = 'EAAPyw9XVuV8BO6SylJsryiV8r3HBZA5tqSYbVidrjUmPsxfc17k1OhZAb3t0ZB997Lu3rwM4PLCZCwoYHcwMhgeCmOha461I7OTaLTWDwgoLziFnzduyTSGxctL6pLZC3rs1IffsgeZAZBzH2ZALbk9bLIz6oiPolniOnksufYjeZBOdWU0mCXXtUezCZA5fGZCctT8QhrZBQ4nC3cQprycbnRWE21uKdxcrQZCAV1nMZD';
            $phoneId = '523188307547107';
            $version = 'v21.0';
            $payload = [
                'messaging_product' => 'whatsapp',
                'to' => '522216075444',
                'type' => 'template',
                'template' => [
                    'name' => 'hello_world',
                    'language' => [
                        'code' => 'en_US',
                    ],
                ],
            ];

            $message = Http::withToken($token)
                    ->post('https://graph.facebook.com/'.$version.'/'. $phoneId.'/messages', $payload)
                    ->throw()
                    ->json();

            return response()->json([
                'success' => true,
                'data' => $message,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage(),
            ], 500);
        }
    }
}
