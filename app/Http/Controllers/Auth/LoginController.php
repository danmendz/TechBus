<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) 
    { 
        $credentials = $request->only('email', 'password'); 
        if (Auth::attempt($credentials)) 
        { 
            $request->session()->regenerate(); 
            $user = Auth::user(); 
            
            if ($user->role === User::ROL_CLIENTE)
            { 
                return redirect()->to('/dashboard');

            } else { 
                return redirect()->to('/administracion'); 
            } 
        } 
        return back()->withErrors([ 'email' => 'The provided credentials do not match our records.', ]); 
    }
}
