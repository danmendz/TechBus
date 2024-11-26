<?php

namespace App\Filament\Widgets;

use App\Models\Autobus;
use App\Models\Ruta;
use App\Models\Ubicacion;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class adminWidgetStats extends BaseWidget
{
    public static function canView(): bool
    {
        return Auth::user()->isAdmin() || Auth::user()->isOperativo();
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Rutas', $this->getRutas()),
            Stat::make('Autobuses activos', $this->getActiveBuses()),
            Stat::make('Ubicaciones', $this->getUbicaciones()),
        ];
    }

    protected function getUsers() 
    {
        $totalUsers = User::get()->count();
        return $totalUsers;
    }

    protected function getActiveBuses() 
    {
        $totalActiveBuses = Autobus::where('estatus_autobus', 'Disponible')->get()->count();
        return $totalActiveBuses;
    }

    protected function getRutas() 
    {
        $totalRutas = Ruta::get()->count();
        return $totalRutas;
    }

    protected function getUbicaciones() 
    {
        $totalUbicaciones = Ubicacion::get()->count();
        return $totalUbicaciones;
    }
}
