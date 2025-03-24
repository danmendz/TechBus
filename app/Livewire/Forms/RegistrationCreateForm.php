<?php

namespace App\Livewire\Forms;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Filament\Events\Auth\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Rule;
use Livewire\Form;

class RegistrationCreateForm extends Form
{
    use PasswordValidationRules;
    
    public string $name = '';
    public string $surnames = '';
    public string $phone = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $terms = false;
    public array $countryCodes = [];
    public string $countryCode = '52';

    public function validateFirstStep()
    {
        $this->validate([
            'name' => 'required|string|min:5|max:255',
            'surnames' => 'required|string|min:5|max:255',
            'phone' => 'required|string|digits:10',
        ]);
    }

    public function validateSecondStep()
    {
        $this->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => array_merge($this->passwordRules(), ['required', 'confirmed']),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
        ]);
    }

    public function createUser()
    {
        $this->validateSecondStep();
        
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