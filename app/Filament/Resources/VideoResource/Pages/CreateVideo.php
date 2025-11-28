<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use App\Jobs\SendVideoNotifications;
use App\Services\NotificationService;
use App\Services\VideoForumService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;

class CreateVideo extends CreateRecord
{
    protected static string $resource = VideoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        // Clear the cache after creating a video to ensure it appears on the site immediately
        cache()->forget('all_videos');
        cache()->forget('recent_videos');

        // Declanșează trimiterea notificărilor după crearea video-ului
        try {
            // Trimite notificări prin email
            SendVideoNotifications::dispatch($this->record);
            Log::info("Video notification job dispatched for video: {$this->record->title}");

            // Trimite notificări în aplicație pentru toți utilizatorii
            $notificationService = new NotificationService();
            $notificationService->sendNewVideoNotification($this->record);
            Log::info("Database notifications sent for video: {$this->record->title}");

            // Creează thread în forum pentru videoclip
            $forumService = new VideoForumService();
            $thread = $forumService->createThreadForVideo($this->record);
            Log::info("Forum thread created for video: {$this->record->title}, thread_id: {$thread->id}");

            // Afișează un mesaj de succes folosind Filament Notification
            Notification::make()
                ->title('Video creat cu succes!')
                ->body('Utilizatorii vor fi notificați și discuția a fost creată în forum.')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Log::error("Failed to dispatch notifications: " . $e->getMessage());

            Notification::make()
                ->title('Video creat')
                ->body('A apărut o problemă la trimiterea notificărilor.')
                ->warning()
                ->send();
        }
    }
}
