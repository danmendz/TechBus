<?php

namespace App\Livewire;

use App\Actions\Fortify\PasswordValidationRules as FortifyPasswordValidationRules;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class RegisterForm extends Component
{
    use FortifyPasswordValidationRules;

    public $currentStep = 1;
    public $totalSteps = 2;

    public $name = '';
    public $surnames = '';
    public $phone = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $type;
    public $terms;
    public $countryCode = '52';
    public $countryCodes = [];
    public $recaptchaToken;

    public function render()
    {
        return view('livewire.auth.register-form', [
            'countryCodes' => $this->loadCountryCodes(),
        ]);
    }

    public function incrementStep()
    {
        $this->validateFirstForm();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function decrementStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
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
            return redirect()->route('dashboard');
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
                    ],
                    [
                        'name' => ['required', 'string', 'min:5', 'max:255'],
                        'surnames' => ['required', 'string', 'min:5', 'max:255'],
                        'phone' => ['required', 'string', 'digits:10'],
                    ]
                )->validate();
                break;
            default:
                break;
        }
    }

    public function loadCountryCodes()
    {
        $response = Http::get('https://country.io/phone.json');

        if ($response->successful()) {
            return $this->countryCodes = $response->json();
        } else {
            return $this->countryCodes = ['MX' => '52', 'US' => '1'];
        }
    }
}