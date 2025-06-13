<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVideo extends CreateRecord
{
    protected static string $resource = VideoResource::class;

    protected function afterCreate(): void
    {
        // Clear the cache after creating a video to ensure it appears on the site immediately
        cache()->forget('all_videos');
        cache()->forget('recent_videos');
    }
}
