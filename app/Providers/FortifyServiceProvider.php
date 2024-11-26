<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Redirección de usuarios sin autenticación de dos factores
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                return $this->redirectBasedOnRole();
            }

            private function redirectBasedOnRole()
            {
                $usertype = Auth::user()->type;

                switch ($usertype) {
                    case 'admin':
                        return redirect()->to('/gestion'); 
                    case 'operativo':
                        return redirect()->to('/gestion'); 
                    case 'conductor':
                        return redirect()->to('/gestion'); 
                    case 'cliente':
                        return redirect()->route('dashboard');
                    default:
                        return redirect()->back();
                }
            }
        });

        // Redirección de usuarios con autenticación de dos factores
        $this->app->instance(TwoFactorLoginResponse::class, new class implements TwoFactorLoginResponse {
            public function toResponse($request)
            {
                return $this->redirectBasedOnRole();
            }

            private function redirectBasedOnRole()
            {
                $usertype = Auth::user()->type;

                switch ($usertype) {
                    case 'admin':
                        return redirect()->to('/gestion'); 
                    case 'cliente':
                        return redirect()->route('dashboard');
                    default:
                        return redirect()->back();
                }
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(3)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
