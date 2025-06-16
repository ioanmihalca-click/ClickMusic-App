<?php

namespace App\Filament\Resources\NewsletterSubscriberResource\Pages;

use App\Filament\Resources\NewsletterSubscriberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsletterSubscriber extends CreateRecord
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // La creare, toate înregistrările noi sunt de tip subscriber (nu campanii)
        $data['status'] = 'pending';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
