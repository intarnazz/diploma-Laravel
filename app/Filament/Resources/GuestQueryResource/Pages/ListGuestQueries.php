<?php

namespace App\Filament\Resources\GuestQueryResource\Pages;

use App\Filament\Resources\GuestQueryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuestQueries extends ListRecords
{
    protected static string $resource = GuestQueryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
