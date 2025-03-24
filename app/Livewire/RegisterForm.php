<?php

namespace App\Livewire;

use App\Actions\Fortify\PasswordValidationRules as FortifyPasswordValidationRules;
use App\Livewire\Forms\RegisterCreateForm;
use App\Livewire\Forms\RegistrationCreateForm;
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
    public int $currentStep = 1;
    public int $totalSteps = 2;
    public RegistrationCreateForm $registerCreate;

    protected $queryString = ['currentStep'];

    public function mount()
    {
        $this->registerCreate->countryCodes = $this->loadCountryCodes();
    }

    public function loadCountryCodes(): array
    {
        $response = Http::get('https://country.io/phone.json');
        return $response->successful() ? $response->json() : ['MX' => '52', 'US' => '1'];
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }

    public function incrementStep()
    {
        try {
            $this->registerCreate->validateFirstStep();
            $this->currentStep++;
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        }
    }

    public function decrementStep()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        $user = $this->registerCreate->createUser();
        return redirect()->route('dashboard');
    }
}