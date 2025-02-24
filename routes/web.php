<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Notifications\WhatsappController;
use App\Livewire\BusTicketStepper;
use App\Livewire\RegisterForm;
use App\Livewire\SendNotifications;
use Illuminate\Support\Facades\Route;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('ado');
})->name('welcome');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/buy-tickets', function() {
    return view('payment.buy-tickets');
})->name('buy.tickets');

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
Route::get('success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

/**
 * Livewire
 */
Route::get('/register-form', RegisterForm::class)->name('register.form');
Route::get('/ticket-stepper', BusTicketStepper::class)->name('ticket.stepper');

/**
 * Whatsapp
 */
Route::get('/send-message', [WhatsappController::class, 'sendMessages'])->name('send.message');
Route::get('/send-notifications', SendNotifications::class)->name('send.whatsapp');

/**
 * Complements
 */
Route::get('/stepper', function() {
    return view('payment.stepper.stepper');
})->name('stepper');

Route::get('/stripe-form', function() {
    return view('payment.stripe');
});

Route::get('/profile-information', function() {
    return view('profile.show-options');
});