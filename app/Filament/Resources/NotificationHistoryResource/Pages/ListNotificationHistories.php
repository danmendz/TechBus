<?php

namespace App\Filament\Resources\NotificationHistoryResource\Pages;

use App\Filament\Resources\NotificationHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotificationHistories extends ListRecords
{
    protected static string $resource = NotificationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
