<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return [
            'required',
            'string',
            Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
            'confirmed',
            function ($attribute, $value, $fail) {
                // Validación de números consecutivos
                if (preg_match('/012|123|234|345|456|567|678|789|890|1234|2345|3456|4567|5678|6789/', $value)) {
                    $fail('La contraseña no puede contener números consecutivos.');
                }
    
                // Validación de letras consecutivas
                if (preg_match('/abcdefghijklmnopqrstuvwxyz|zyxwvutsrqponmlkjihgfedcba/', $value)) {
                    $fail('La contraseña no puede contener letras consecutivas.');
                }
            },
        ];
    }
}
