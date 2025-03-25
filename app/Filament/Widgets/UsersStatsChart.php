<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersStatsChart extends ChartWidget
{
    protected static ?string $heading = 'Cuentas de usuarios creadas';
    protected static string $color = 'info';

    public static function canView(): bool
    {
        return Auth::user()->isAdmin();
    }

    protected function getData(): array
    {
        $year = Carbon::now()->year;

        // Consulta para contar usuarios creados por mes
        $usersByMonth = DB::table('users')
            ->selectRaw('MONTH(created_at) AS month, COUNT(id) AS count')
            ->whereRaw('YEAR(created_at) = ?', [$year])
            ->groupByRaw('MONTH(created_at)')
            ->pluck('count', 'month')
            ->toArray();

        // Inicializar todos los meses en 0 para evitar valores faltantes
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $usersByMonth[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'title' => 'Usuarios',
                    'label' => 'Cuentas de usuarios creadas',
                    'data' => $data,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}