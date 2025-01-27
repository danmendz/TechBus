<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class PhoneNumber extends Component
{
    public $countryCode;
    public $countryCodes = [];
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->loadCountryCodes();
    }

    public function loadCountryCodes()
    {
        $response = Http::get('https://country.io/phone.json');

        if ($response->successful()) {
            $this->countryCodes = $response->json();
        } else {
            $this->countryCodes = ['MX' => '52', 'US' => '1'];
        }
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.phone-number');
    }
}
