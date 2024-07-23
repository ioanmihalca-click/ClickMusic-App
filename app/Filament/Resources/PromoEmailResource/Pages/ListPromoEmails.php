<?php

namespace App\Filament\Resources\PromoEmailResource\Pages;

use App\Filament\Resources\PromoEmailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPromoEmails extends ListRecords
{
    protected static string $resource = PromoEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
