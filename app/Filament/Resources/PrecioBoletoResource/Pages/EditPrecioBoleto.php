<?php

namespace App\Filament\Resources\PrecioBoletoResource\Pages;

use App\Filament\Resources\PrecioBoletoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrecioBoleto extends EditRecord
{
    protected static string $resource = PrecioBoletoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
