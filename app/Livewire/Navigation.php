<?php

namespace App\Livewire;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LogoutResponse;
use Livewire\Component;

class Navigation extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        return $this->redirect('/');
    }

    public function render()
    {
        $breadcrumbMap = [
            'dashboard' => 'Panel',
            'profile' => 'Perfil',
            'settings' => 'Configuración',
            'buy-tickets' => 'Comprar boletos'
        ];

        // Obtiene el nombre de la ruta actual
        $currentRoute = request()->route()->getName();
        $breadcrumb = [];

        // Divide la ruta en partes
        $routeParts = explode('.', $currentRoute);

        // Construye el breadcrumb dinámicamente
        foreach ($routeParts as $part) {
            if (array_key_exists($part, $breadcrumbMap)) {
                $breadcrumb[] = $breadcrumbMap[$part];
            }
        }
        
        return view('livewire.navigation', ['breadcrumb' => $breadcrumb]);
    }
}
