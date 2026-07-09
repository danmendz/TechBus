<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function updatePhone(Request $request)
    {
        // Validar el número de teléfono con formato y longitud adecuados
        $request->validate([
            'phone' => ['required', 'string', 'max:10', 'regex:/^\+?[0-9]{7,15}$/']
        ]);

        // Verificar si el usuario está autenticado
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        // Actualizar el número de teléfono
        $user->phone = $request->phone;
        if ($user->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update phone number'], 500);
        }
    }
}