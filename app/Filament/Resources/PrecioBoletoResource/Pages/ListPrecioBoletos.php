<?php

namespace App\Filament\Resources\PrecioBoletoResource\Pages;

use App\Filament\Resources\PrecioBoletoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrecioBoletos extends ListRecords
{
    protected static string $resource = PrecioBoletoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
