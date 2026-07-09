<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Redirige a los usuarios después de iniciar sesión.
     */
    public function authenticated($request, $user)
    {
        $usertype = $user->type;

        switch ($usertype) {
            case 'admin':
            case 'operativo':
            case 'conductor':
                return redirect()->to('/gestion');
            case 'cliente':
                return redirect()->route('dashboard');
            default:
                return redirect()->back();
        }
    }
}