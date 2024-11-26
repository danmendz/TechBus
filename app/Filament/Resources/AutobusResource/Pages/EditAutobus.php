<?php

namespace App\Filament\Resources\AutobusResource\Pages;

use App\Filament\Resources\AutobusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAutobus extends EditRecord
{
    protected static string $resource = AutobusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
