<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Notifications\WhatsappController;
use App\Http\Controllers\ResultadoController;
use App\Livewire\Navigation;
use App\Livewire\PaymentStep;
use App\Livewire\RegisterForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;
use Livewire\Livewire;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\MapaController;

Route::get('/', function () {
    return view('ado');
})->name('welcome');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/**
 * Google Login
 */
Route::controller(SocialiteController::class)->group(function() {
    Route::get('/auth/redirection/{provider}', 'authProviderRedirect')->name('auth.redirection');
    Route::get('/auth/{provider}/callback', 'socialAuthentication')->name('auth.callback');
});

/**
 * Stripe
 */
Route::post('stripe', [StripeController::class, 'stripe'])->name('stripe');
Route::get('success', [StripeController::class, 'success'])->name('success');
Route::get('cancel', [StripeController::class, 'cancel'])->name('cancel');

/**
 * Livewire
 */
Route::get('/register-form', RegisterForm::class)->name('register.form');

Route::get('/stepper', function() {
    return view('payment.stepper.stepper');
})->name('stepper');

Route::get('/stripe-form', function() {
    return view('payment.stripe');
});

Route::get('/profile-information', function() {
    return view('profile.show-options');
});

/**
 * Whatsapp
 */
Route::get('/send-message', [WhatsappController::class, 'sendMessages'])->name('send.message');

/**
 * Livewire
 */
Route::get('/payment-step', PaymentStep::class);

Route::get('/nosotros', function () {
    return view('auth.nosotros');
})->name('nosotros');

Route::get('/ado', function () {
    return view('ado');
})->name('ado');

Route::get('/metodo-pago', function () {
    return view('auth.metodo-pago');
})->name('metodo_de _pago');

// routes/web.php
Route::get('/resultados.html', function () {
    return view('resultados');
});


Route::get('/resultados', [ResultadoController::class, 'index']);

Route::get('/formulario', [FormularioController::class, 'showForm'])
    ->middleware('auth') // Protege la ruta para usuarios autenticados
    ->name('formulario');
