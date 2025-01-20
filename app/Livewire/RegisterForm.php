<?php

namespace App\Livewire;

use App\Actions\Fortify\PasswordValidationRules as FortifyPasswordValidationRules;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

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

    public function render()
    {
        return view('livewire.register-form');
    }

    public function incrementStep() {
        $this->validateForm();
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep ++;
        }
    }

    public function decrementStep() {
        if ($this->currentStep > 1) {
            $this->currentStep --;
        }
    }

    public function submit() {
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
        $this->reset();
    }

    public function validateForm() {
        switch ($this->currentStep) {
            case 1:
                Validator::make(
                    [
                        'name' => $this->name,
                        'surnames' => $this->surnames,
                        'phone' => $this->phone,
                    ],
                    [
                        'name' => ['required', 'string', 'max:255'],
                        'surnames' => ['required', 'string', 'max:255'],
                        'phone' => ['required', 'string', 'max:10'],
                    ]
                )->validate();
                break;
            default:
                // Puedes manejar otros pasos aquí si es necesario
                break;
        }
    }    
}
