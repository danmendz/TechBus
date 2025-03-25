<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminWidgetStats;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\UsersStatsChart;
use App\Filament\Widgets\PurchaseHistoryChart;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            AdminWidgetStats::class,
            UsersStatsChart::class,
			PurchaseHistoryChart::class,
        ];
    }
}