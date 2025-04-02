<?php

namespace App\Filament\Resources\CorridaResource\Pages;

use App\Filament\Resources\CorridaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCorridas extends ListRecords
{
    protected static string $resource = CorridaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
