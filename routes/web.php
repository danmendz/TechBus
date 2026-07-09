<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Notifications\WhatsappController;
use App\Livewire\BusTicketStepper;
use App\Http\Controllers\ResultadoController;
use App\Livewire\Navigation;
use App\Livewire\PaymentStep;
use App\Livewire\RegisterForm;
use App\Livewire\SendNotifications;
use Illuminate\Support\Facades\Route;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use Filament\Facades\Filament;
use Livewire\Livewire;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('ado');
})->name('welcome');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    /**
     * Livewire components
     */
    Route::post('/update-phone', [UserController::class, 'updatePhone'])->name('update.phone');

    Route::get('/my-tickets', function () {
        return view('dashboard.ticket-list');
    })->name('my.tickets');

    Route::get('/buy-tickets', function() {
        return view('payment.buy-tickets');
    })->name('buy.tickets');

    /**
     * Stripe
     */
    Route::get('success', [StripeController::class, 'success'])->name('stripe.success');
    Route::get('cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');
});


/**
 * Google autentication
 */
Route::controller(SocialiteController::class)->group(function() {
    Route::get('/auth/redirection/{provider}', 'authProviderRedirect')->name('auth.redirection');
    Route::get('/auth/{provider}/callback', 'socialAuthentication')->name('auth.callback');
});

/**
 * Livewire form
 */
Route::get('/register-form', RegisterForm::class)->name('register.form');

/**
 * Complements
 */
Route::get('/stepper', function() {
    return view('payment.stepper.stepper');
})->name('stepper');

/**
 * Views about us
 */
Route::get('/nosotros', function () {
    return view('company.nosotros');
})->name('nosotros');

Route::get('/ado', function () {
    return view('ado');
})->name('ado');

Route::get('/metodo-pago', function () {
    return view('company.metodo-pago');
})->name('metodo_de _pago');

/**
 * DOM form
 */
Route::get('/resultados', [ResultadoController::class, 'index']);
Route::get('/formulario', [FormularioController::class, 'showForm'])
    ->middleware('auth') // Protege la ruta para usuarios autenticados
    ->name('formulario');