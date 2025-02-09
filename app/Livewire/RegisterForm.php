<?php

namespace App\Livewire;

use App\Actions\Fortify\PasswordValidationRules as FortifyPasswordValidationRules;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class RegisterForm extends Component
{
    use FortifyPasswordValidationRules;
    public $currentStep = 1;
    public $totalSteps = 2;

    public $name;
    public $surnames;
    public $phone;
    public $type;
    public $email;
    public $password;
    public $password_confirmation;
    public $terms;
    public $countryCode;
    public $countryCodes = [];

    public function render()
    {
        return view('livewire.auth.register-form', [
            'countryCodes' => $this->loadCountryCodes(),
        ]);
    }

    public function incrementStep() {
        $this->validateFirstForm();
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep ++;
        }
    }

    public function decrementStep() {
        if ($this->currentStep > 1) {
            $this->currentStep --;
        }
    }

    public function validateSecondForm() {
        Validator::make(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'terms' => $this->terms,
            ],
            [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => array_merge(
                    $this->passwordRules(),
                    ['confirmed']
                ),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ]
        )->validate();
    }

    public function submit() {
        $this->validateSecondForm();
        
        $cleanCountryCode = str_replace(['+', '-'], '', $this->countryCode);
        $phoneWithCountryCode = $cleanCountryCode . $this->phone;
    
        $user = User::create([
            'name' => $this->name,
            'surnames' => $this->surnames,
            'phone' => $phoneWithCountryCode,
            'type' => User::ROL_DEFAULT,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    
        if ($user) {
            event(new Registered($user));
            Auth::login($user);
            return redirect()->to('/dashboard');
        }
    }

    public function validateFirstForm() {
        switch ($this->currentStep) {
            case 1:
                Validator::make(
                    [
                        'name' => $this->name,
                        'surnames' => $this->surnames,
                        'phone' => $this->phone,
                        // 'countryCode' => $this->countryCode,
                    ],
                    [
                        'name' => ['required', 'string', 'max:255'],
                        'surnames' => ['required', 'string', 'max:255'],
                        'phone' => ['required', 'string', 'max:10'],
                        // 'countryCode' => ['required', 'string', 'max:255'],
                    ]
                )->validate();
                break;
            default:
                break;
        }
    }

    // Método para obtener los códigos de país desde la API
    public function loadCountryCodes()
    {
        $response = Http::get('https://country.io/phone.json');

        if ($response->successful()) {
            $countryCodesObtained = $this->countryCodes = $response->json();
            return $countryCodesObtained;

        } else {
            $countryCodesObtained = $this->countryCodes = ['MX' => '52', 'US' => '1'];
            return $countryCodesObtained;
        }
    }
}
