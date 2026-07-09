<?php

namespace App\Filament\Resources\TipoBoletoResource\Pages;

use App\Filament\Resources\TipoBoletoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoBoleto extends EditRecord
{
    protected static string $resource = TipoBoletoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
