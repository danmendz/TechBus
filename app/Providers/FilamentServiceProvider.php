<?php

namespace App\Providers;

use Filament\Facades\Filament; 
use Filament\Panel; 
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Filament::serving(function () { 
        //     Filament::registerPanels([ 
        //         Panel::make('admin') 
        //             ->id('admin') 
        //             // ->label('Admin Panel') 
        //             ->path('admin') 
        //             ->middleware(['auth', 'admin']), 
        //         Panel::make('operativo') 
        //             ->id('operativo') 
        //             // ->label('Operativo Panel') 
        //             ->path('operativo') 
        //             ->middleware(['auth', 'operativo']), 
        //         Panel::make('conductor') 
        //             ->id('conductor') 
        //             // ->label('Conductor Panel') 
        //             ->path('conductor') 
        //             ->middleware(['auth', 'conductor']),
        //     ]);
        // });
    }
}
