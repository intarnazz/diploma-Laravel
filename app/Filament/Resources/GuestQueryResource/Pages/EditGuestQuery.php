<?php

namespace App\Filament\Resources\GuestQueryResource\Pages;

use App\Filament\Resources\GuestQueryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuestQuery extends EditRecord
{
    protected static string $resource = GuestQueryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
