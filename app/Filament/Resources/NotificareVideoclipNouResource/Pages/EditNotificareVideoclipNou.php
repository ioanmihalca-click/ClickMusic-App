<?php

namespace App\Filament\Resources\NotificareVideoclipNouResource\Pages;

use App\Filament\Resources\NotificareVideoclipNouResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotificareVideoclipNou extends EditRecord
{
    protected static string $resource = NotificareVideoclipNouResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
