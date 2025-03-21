<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public function showForm()
    {
        // El middleware 'auth' ya se encarga de redirigir a los no autenticados
        return view('formulario');
    }
}