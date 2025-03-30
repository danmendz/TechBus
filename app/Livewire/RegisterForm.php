<?php

namespace App\Livewire;

use App\Livewire\Forms\RegistrationCreateForm;
use Livewire\Component;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Http;
class RegisterForm extends Component
{
    public int $currentStep = 1;
    public int $totalSteps = 2;
    public RegistrationCreateForm $registerCreate;

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
            // throw $e;
            session()->flash('error', 'No se pudo registrar los datos. Por favor, inténtelo de nuevo.');
            return redirect()->route('register.form');
        }
    }

    public function decrementStep()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        $user = $this->registerCreate->createUser();

        if ($user) {
            session()->flash('success', 'Cuenta creada con éxito');
        }
        return redirect()->route('dashboard');
    }
}