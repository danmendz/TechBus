<?php

namespace App\Filament\Resources\NotificationHistoryResource\Pages;

use App\Filament\Resources\NotificationHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotificationHistory extends EditRecord
{
    protected static string $resource = NotificationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
