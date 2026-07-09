<?php

namespace App\Filament\Resources\AsientoResource\Pages;

use App\Filament\Resources\AsientoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsiento extends EditRecord
{
    protected static string $resource = AsientoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
