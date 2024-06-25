<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuperUserNotification extends Notification
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
        return (new MailMessage)
            ->from('contact@clickmusic.ro', 'Click Music Ro')
            ->greeting('Salut, ' . $notifiable->name . '!')
            ->line('Ți-a fost atribuit rolul de Super_User pe platforma noastră! 🌟')
            ->line('Ce înseamnă asta pentru tine?')
            ->line('✅ Acces PREMIUM gratuit pe viață')
            ->line('✅ Conținut exclusiv și în avanpremieră')
            ->line('✅ Prioritate la suportul tehnic')
            ->line('Suntem recunoscători pentru ajutorul tău în promovarea aplicatiei de streaming muzical Click Music!')
            ->action('Videoclipuri', url('/videoclipuri'))
            ->line('Nu ezita să ne contactezi dacă ai întrebări sau sugestii.')
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
