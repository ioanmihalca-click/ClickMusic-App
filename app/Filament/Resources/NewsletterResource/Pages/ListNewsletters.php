<?php

namespace App\Filament\Resources\NewsletterResource\Pages;

use App\Filament\Resources\NewsletterResource;
use App\Filament\Resources\NewsletterSubscriberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsletters extends ListRecords
{
    protected static string $resource = NewsletterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('viewSubscribers')
                ->label('Vezi abonați')
                ->icon('heroicon-o-users')
                ->color('success')
                ->url(NewsletterSubscriberResource::getUrl()),
        ];
    }
}
