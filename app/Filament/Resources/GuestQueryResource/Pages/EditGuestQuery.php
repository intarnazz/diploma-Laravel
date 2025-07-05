<?php

namespace App\Filament\Resources\GuestQueryResource\Pages;

use App\Filament\Resources\GuestQueryResource;
use App\Models\GuestQuery;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\DB;

class EditGuestQuery extends EditRecord
{
    protected static string $resource = GuestQueryResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('deleteNext')
                ->label('Удалить и далее →')
                ->requiresConfirmation()
                ->color('danger')
                ->action(function () {
                    $current = $this->record;
                    $current->delete();
                    $next = GuestQuery::orderBy('created_at', 'asc')
                        ->first();
                    if ($next) {
                        return redirect(GuestQueryResource::getUrl('edit', ['record' => $next->getKey()]));
                    }
                    return redirect(GuestQueryResource::getUrl('index'));
                }),
        ];
    }

    protected function getFormActions(): array
    {
        return [

        ];
    }
}
