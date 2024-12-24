<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

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

// STRIPE
Route::post('stripe', [StripeController::class, 'stripe'])->name('stripe');
Route::get('success', [StripeController::class, 'success'])->name('success');
Route::get('cancel', [StripeController::class, 'cancel'])->name('cancel');

Route::get('/stepper', function() {
    return view('payment.stepper.stepper');
})->name('stepper');

Route::get('/stripe-form', function() {
    return view('payment.stripe');
});

Route::get('/profile-information', function() {
    return view('profile.show-options');
});