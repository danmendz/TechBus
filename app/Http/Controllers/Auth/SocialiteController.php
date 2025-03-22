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
    public function socialAuthentication($provider)
    {
        try {
            if ($provider) {
                $socialUser = Socialite::driver($provider)->user();
                // dd($socialUser);

                switch ($provider) {
                    case 'facebook':
                        $name = $socialUser->user['first_name'];
                        $surnames = $socialUser->user['last_name'];
                        break;

                    case 'google':
                        $name = $socialUser->user['given_name'];
                        $surnames = $socialUser->user['family_name'];
                        break;

                    default:
                        $name = $socialUser->name;
                        $surnames = null;
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
                    ],
                );

                Auth::login($user);

                return redirect('/dashboard');
            }
            abort(404);
        } catch (Exception $e) {
            dd($e);
        }
    }
}
