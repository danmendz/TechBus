<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Rules\Recaptcha;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
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
        $this->registerLoginResponse();
        $this->registerTwoFactorResponse();
    }

    protected function registerLoginResponse(): void
    {
        $this->app->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse {
                public function toResponse($request)
                {
                    $user = $request->user();
                    
                    if (!$user) {
                        return redirect('/login');
                    }

                    switch ($user->type) {
                        case 'admin':
                        case 'operativo':
                        case 'conductor':
                            return redirect()->intended('/gestion');
                        case 'cliente':
                            return redirect()->intended(route('dashboard'));
                        default:
                            return redirect('/');
                    }
                }
            };
        });
    }

    protected function registerTwoFactorResponse(): void
    {
        $this->app->singleton(TwoFactorLoginResponse::class, function () {
            return new class implements TwoFactorLoginResponse {
                public function toResponse($request)
                {
                    $user = $request->user();
                    
                    if (!$user) {
                        return redirect('/login');
                    }

                    switch ($user->type) {
                        case 'admin':
                            case 'operativo':
                            case 'conductor':
                            return redirect()->intended('/gestion');
                        case 'cliente':
                            return redirect()->intended(route('dashboard'));
                        default:
                            return redirect('/');
                    }
                }
            };
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

        $this->configureRateLimiting();

        Fortify::authenticateUsing(function (Request $request) {
            $this->validateLoginRequest($request);

            $user = Auth::guard('web')->attempt(
                $request->only(Fortify::username(), 'password'),
                $request->filled('remember')
            ) ? Auth::guard('web')->user() : null;

            if ($user && !$user->is_active) {
                Auth::logout();
                throw ValidationException::withMessages([
                    Fortify::username() => __('Tu cuenta está desactivada.'),
                ]);
            }

            return $user;
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(3)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }

    protected function validateLoginRequest(Request $request): void
    {
        $request->validate([
            Fortify::username() => 'required|string',
            'password' => 'required|string',
            'recaptchaToken' => ['required', new Recaptcha],
        ]);

        // Validación adicional: verificar si el dominio de email es válido
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $domain = explode('@', $request->email)[1] ?? '';
            if (!checkdnsrr($domain, 'MX')) {
                throw ValidationException::withMessages([
                    Fortify::username() => __('El dominio de tu correo electrónico no es válido.'),
                ]);
            }
        }
    }
}