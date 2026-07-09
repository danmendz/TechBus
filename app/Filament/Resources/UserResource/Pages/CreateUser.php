<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\CreateRecordAndRedirectToIndex;
use App\Filament\Resources\UserResource;
use Filament\Actions;

class CreateUser extends CreateRecordAndRedirectToIndex
{
    protected static string $resource = UserResource::class;
}
