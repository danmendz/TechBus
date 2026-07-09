<?php

namespace App\Filament\Resources\FlotaAutobusResource\Pages;

use App\Filament\Resources\FlotaAutobusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFlotaAutobuses extends ListRecords
{
    protected static string $resource = FlotaAutobusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
