<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PurchaseHistoryChart extends ChartWidget
{
    protected static ?string $heading = 'Historial de Compras por Mes';
    
    // Configura el color del gráfico
    protected static string $color = 'primary';

    // Define si el widget puede ser visto solo por administradores
    public static function canView(): bool
    {
        return auth()->user()->isAdmin();
    }

    // Obtener los datos para la gráfica
    protected function getData(): array
    {
        // Consulta para contar las compras por mes
        $purchaseData = DB::table('purchase_history')
            ->selectRaw('MONTH(created_at) AS month, COUNT(id) AS total_purchases')
            ->groupByRaw('MONTH(created_at)')
            ->get();

        // Convertir los resultados en un formato adecuado para la gráfica
        $purchaseData = $purchaseData->mapWithKeys(function ($item) {
            return [$item->month => $item->total_purchases];
        });

        // Crear el arreglo de datos para la gráfica
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $purchaseData[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'title' => 'Compras Mensuales',
                    'label' => 'Total de compras por mes',
                    'data' => $data,
                    'backgroundColor' => '#4CAF50', // Color de fondo de las barras
                    'borderColor' => '#388E3C', // Color del borde de las barras
                ],
            ],
            'labels' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        ];
    }

    // Tipo de gráfica (en este caso, barras)
    protected function getType(): string
    {
        return 'bar';
    }
}