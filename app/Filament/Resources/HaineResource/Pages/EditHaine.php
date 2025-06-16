<?php

namespace App\Filament\Resources\HaineResource\Pages;

use App\Filament\Resources\HaineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHaine extends EditRecord
{
    protected static string $resource = HaineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
