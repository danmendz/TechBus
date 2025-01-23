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
        // Especificar el guard web explícitamente
        Auth::guard('web')->logout();

        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
