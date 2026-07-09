<?php

namespace App\Livewire\Forms;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Rules\Recaptcha;
use Filament\Events\Auth\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Livewire\Attributes\Rule;
use Livewire\Form;

class RegistrationCreateForm extends Form
{
    use PasswordValidationRules;

    #[Rule('required|string|min:4|max:10')]
    public $name = '';

    #[Rule('required|string|min:4|max:20')]
    public $surnames = '';

    #[Rule('required|string|digits:10')]
    public $phone = '';

    #[Rule('required|string|email|max:50|unique:users')]
    public $email = '';
        
    #[Rule('required|string|confirmed')]
    public $password = '';

    public $password_confirmation = '';    
    public array $countryCodes = [];
    public string $countryCode = '52';
    public bool $terms = false;
    public $recaptchaToken;

    public function rules()
    {
        return [
            'password' => array_merge($this->passwordRules(), ['required', 'confirmed']),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
            'recaptchaToken' => ['required', new Recaptcha()],
        ];
    }

    public function messages()
    {
        return [
            'surnames.required' => 'El campo apellidos es obligatorio.',
            'surnames.min' => 'El apellido debe tener al menos :min caracteres.',
            'surnames.max' => 'El apellido no puede superar los :max caracteres.',
            'surnames.string' => 'El apellido debe ser una cadena de texto válida.',
            'terms.required' => 'Debes aceptar los términos y condiciones.',
        ];
    }

    public function createUser()
    {
        $this->validate();
        
        $user = User::create([
            'name' => $this->name,
            'surnames' => $this->surnames,
            'phone' => $this->getFullPhoneNumber(),
            'type' => User::ROL_DEFAULT,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));
        Auth::login($user);
        
        return $user;
    }

    protected function getFullPhoneNumber(): string
    {
        return str_replace(['+', '-'], '', $this->countryCode) . $this->phone;
    }
}