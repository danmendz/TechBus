<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PhoneModal extends Component
{
    public $phone;
    public $countryCode;
    public $countryCodes = [];
    public $showModal = true;

    public function savePhone()
    {
        $cleanCountryCode = str_replace(['+', '-'], '', $this->countryCode);
        $phoneWithCountryCode = $cleanCountryCode . $this->phone;

        // Validación: El número de teléfono debe ser numérico y máximo 10 dígitos
        $this->validate([
            'phone' => 'required|digits_between:8,10',
        ], [
            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.digits_between' => 'El número de teléfono debe tener entre 8 y 10 dígitos.',
        ]);

        $user = Auth::user();
        $user->update(['phone' => $phoneWithCountryCode]);

        $this->showModal = false;

        // ✅ Se usa `$this->dispatch()` en Livewire 3
        $this->dispatch('phoneUpdated');
    }

    // Método para obtener los códigos de país desde la API
    public function loadCountryCodes()
    {
        $response = Http::get('https://country.io/phone.json');

        if ($response->successful()) {
            return $this->countryCodes = $response->json();
        } else {
            return $this->countryCodes = ['MX' => '52', 'US' => '1'];
        }
    }

    public function render()
    {
        return view('livewire.auth.phone-modal', [
            'countryCodes' => $this->loadCountryCodes(),
        ]);
    }
}