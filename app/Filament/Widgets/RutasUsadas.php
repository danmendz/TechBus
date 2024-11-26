<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class RutasUsadas extends BaseWidget
{
    public static function canView(): bool
    {
        return Auth::user()->isConductor();
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Rutas recorridas', '25'),
            Stat::make('Autobuses asignados', '10'),
        ];
    }
}
