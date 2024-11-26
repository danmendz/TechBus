<?php

namespace App\Filament\Resources\FlotaAutobusResource\Pages;

use App\Filament\Resources\FlotaAutobusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFlotaAutobus extends EditRecord
{
    protected static string $resource = FlotaAutobusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
