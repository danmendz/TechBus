<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultadoController extends Controller
{
    public function index(Request $request)
    {
        // Pasar los parámetros de búsqueda a la vista
        return view('resultados', [
            'origin' => $request->query('origin'),
            'destination' => $request->query('destination'),
            'departureDate' => $request->query('departureDate'),
            'returnDate' => $request->query('returnDate'),
        ]);
    }
}
