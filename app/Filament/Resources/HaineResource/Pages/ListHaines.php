<?php

namespace App\Filament\Resources\HaineResource\Pages;

use App\Filament\Resources\HaineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHaines extends ListRecords
{
    protected static string $resource = HaineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
