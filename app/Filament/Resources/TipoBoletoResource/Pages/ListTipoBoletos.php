<?php

namespace App\Filament\Resources\TipoBoletoResource\Pages;

use App\Filament\Resources\TipoBoletoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoBoletos extends ListRecords
{
    protected static string $resource = TipoBoletoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
