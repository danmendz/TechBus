<?php

namespace App\Filament\Resources\PurchaseHistoryResource\Pages;

use App\Filament\Resources\PurchaseHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchaseHistory extends EditRecord
{
    protected static string $resource = PurchaseHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
