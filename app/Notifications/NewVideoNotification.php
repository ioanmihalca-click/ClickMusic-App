<?php

namespace App\Notifications;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewVideoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('contact@clickmusic.ro', 'Click Music Ro')
            ->subject('O noua piesa pe Click Music - ' . $this->video->title)
            ->greeting('Salut ' . $notifiable->name . '!')
            ->line('Am adăugat conținut nou pe platformă:')
            ->line('**' . $this->video->title . '**')
            ->line($this->video->description)
            ->action('Vezi acum', route('videos.show', $this->video->id))
            ->line('Pentru a viziona noul video, trebuie să fii autentificat în aplicație. Îți mulțumesc că faci parte din comunitatea noastră!')
            ->salutation('Cu respect, Click Music');
    }
}
