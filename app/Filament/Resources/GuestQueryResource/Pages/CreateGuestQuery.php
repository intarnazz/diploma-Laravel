<?php

namespace App\Filament\Resources\GuestQueryResource\Pages;

use App\Filament\Resources\GuestQueryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGuestQuery extends CreateRecord
{
    protected static string $resource = GuestQueryResource::class;
}
