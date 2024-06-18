<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificareVideoclipNou extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = 'http://clickmusic.ro//videos/9'; // URL of your video
        $imageUrl = '/img/de mana cu tine cover.webp'; // URL of your cover image

        return (new MailMessage)
        ->from('contact@clickmusic.ro', 'Click Music Ro')
        ->line(new HtmlString("<a href='{$url}'><img src='{$imageUrl}' alt='Video Cover'></a>"))
        ->greeting('Salut, '. $notifiable->name. '!')
        ->subject('Un nou videoclip pe platforma Click Music!')
        ->line('Iti mulțumim pentru că te-ai abonat si ca ne sustii!')
        ->action('Vizualizați Videoclipul', url('/videos/9'))
        ->salutation('Cu respect, Click Music');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
