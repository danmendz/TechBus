<?php

namespace App\Filament\Resources\PurchaseHistoryResource\Pages;

use App\Filament\Resources\PurchaseHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchaseHistories extends ListRecords
{
    protected static string $resource = PurchaseHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
