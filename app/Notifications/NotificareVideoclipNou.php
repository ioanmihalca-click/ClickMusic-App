<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificareVideoclipNou extends Notification implements ShouldQueue
{
    use Queueable;

    public $videoUrl;
    public $imageUrl;
    public $videoName;

    public function __construct($videoUrl, $imageUrl, $videoName)
    {
        $this->videoUrl = $videoUrl;
        $this->imageUrl = $imageUrl;
        $this->videoName = $videoName;
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

    public function withDelay($notifiable)
    {
        return [
            'mail' => now()->addSeconds(2),
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from('contact@clickmusic.ro', 'Click Music Ro')
            ->subject('Un nou videoclip pe platforma Click Music!')
            ->line(new HtmlString("<a href='{$this->videoUrl}'><img src='{$this->imageUrl}' alt=''></a>"))
            ->greeting('Salut, ' . $notifiable->name . '!')
            ->line('Am adaugat un nou videoclip!')
            ->line('Iti mulțumim pentru că te-ai abonat si ca ne sustii!')
            ->line('Pentru a putea vizualiza videoclipul direct din acest email, trebuie sa fii AUTENTIFICAT in aplicatia Click Music.')
            ->line($this->videoName) 
            ->action('Vizualizați Videoclipul', url($this->videoUrl))
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
