<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $user = Auth::user();

        $redirectTo = match ($user->role) {
            1 => route('admin.dashboard'),
            2 => route('admin.dashboard'),
            3 => route('admin.dashboard'),
            4 => route('dashboard'),
            default => route('dashboard'),
        };

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended($redirectTo);
    }

}