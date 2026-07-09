<?php

namespace App\Filament\Resources\AutobusResource\Pages;

use App\Filament\Resources\AutobusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAutobuses extends ListRecords
{
    protected static string $resource = AutobusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
