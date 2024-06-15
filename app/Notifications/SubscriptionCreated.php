<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionCreated extends Notification 
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
        ->greeting('Salut, '. $notifiable->name. '!')
        ->subject('Abonament Creat cu Succes!')
        ->line('Iti mulțumim pentru că te-ai abonat si ca ne sustii!')
        ->line('Acum ai acces la toate videoclipurile premium.')
        ->action('Vizualizați Videoclipuri', url('/videoclipuri'))
        ->line('Daca te razgandesti poti oricand sa anulezi abonamentul din sectiunea Profil/Anuleaza abonamentul')
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
