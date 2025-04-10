<?php

namespace App\Livewire;

use App\Livewire\Forms\RegistrationCreateForm;
use Livewire\Component;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Http;
class RegisterForm extends Component
{
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

    public function submit()
    {
        $user = $this->registerCreate->createUser();

        if ($user) {
            session()->flash('success', 'Cuenta creada con éxito');
        }
        return redirect()->route('dashboard');
    }
}