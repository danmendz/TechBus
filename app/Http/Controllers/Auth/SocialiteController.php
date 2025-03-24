<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Function: authProviderRedirect
     * Description: This function will redirect to Given Provider
     * @param NA
     * @return void
     */
    public function authProviderRedirect($provider)
    {
        // dd($provider);
        if ($provider) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
    }

    /**
     * Function: googleAuthentication
     * Decription: This function will authenticate the user through the Google Account
     * @param NA
     * @return void
     */
    public function socialAuthentication($provider) {
        try {
            if ($provider) {
                $socialUser = Socialite::driver($provider)->stateless()->user();
                // dd($socialUser);

                $name = $socialUser->name;
                $surnames = null;
                $avatarPath = $socialUser->avatar ?? null;

                switch ($provider) {
                    case 'facebook':
                        $avatarPath = $socialUser->attributes['avatar_original'] ?? null;
                        break;

                    case 'google':
                        $name = $socialUser->user['given_name'] ?? $socialUser->name;
                        $surnames = $socialUser->user['family_name'] ?? null;
                        $avatarPath = $socialUser->avatar ?? null;
                        break;
                }

                $user = User::updateOrCreate(
                    [
                        'auth_provider_id' => $socialUser->id,
                    ],
                    [
                        'name' => $name,
                        'surnames' => $surnames,
                        'email' => $socialUser->email,
                        'auth_provider_id' => $socialUser->id,
                        'auth_provider' => $provider,
                        'profile_photo_path' => $avatarPath,
                    ],
                );

                Auth::login($user);

                return redirect()->route('dashboard');
            }
            abort(404);

        } catch (Exception $e) {
            // dd($e);
            return redirect()->route('login')->withErrors(['error' => 'No se puede iniciar sesión con ' . ucfirst($provider) . '. Por favor, inténtelo de nuevo.']);
        }
    }
}
