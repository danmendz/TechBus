<?php

namespace App\Filament\Resources\CategoriaAutobusResource\Pages;

use App\Filament\Resources\CategoriaAutobusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoriaAutobus extends EditRecord
{
    protected static string $resource = CategoriaAutobusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
