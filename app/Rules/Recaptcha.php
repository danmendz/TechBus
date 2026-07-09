<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        $response = $response->json();

        return $response['success'] && $response['score'] > config('services.recaptcha.min_score');
    }

    public function message()
    {
        return 'La verificación de reCAPTCHA falló. Por favor, inténtalo de nuevo.';
    }
}