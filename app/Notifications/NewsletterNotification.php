<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use App\Models\Newsletter;

class NewsletterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $newsletter;
    protected $imageUrl;
    protected $url;
  
    public function __construct(Newsletter $newsletter, $imageUrl, $url,)
    {
        $this->newsletter = $newsletter;
        $this->imageUrl = $imageUrl;
        $this->url = $url;
     
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        $unsubscribeUrl = route('newsletter.unsubscribe', ['email' => $this->newsletter->recipient_email]); 
        
        
        return (new MailMessage)
            ->from('contact@clickmusic.ro', 'Click Music Ro')
            ->subject('Piesa noua de la Click!')
            ->greeting('Salut ' . $this->newsletter->recipient_name . '!')
            ->line('Sper ca acest email te gaseste bine. Vreau sa te anunt ca am lansat o noua piesa!')
            ->line(new HtmlString("<a href='{$this->url}'><img src='{$this->imageUrl}' alt=''></a>"))
            ->action('Asculta pe Youtube', url($this->url))
            ->line('Astept cu drag sa ma saluti si sa-mi spui parerea ta despre piesa intr-un comentariu. Sa ne auzim cu bine!')
            ->salutation(new HtmlString('Cu respect,<br>Click<br><br>
            <a href="https://www.youtube.com/clickmusicromania" style="color: #DC2626; text-decoration: none;" target="_blank" rel="noopener noreferrer">YouTube Click Music</a> | 
            <a href="https://clickmusic.ro" style="color: #3B82F6; text-decoration: none;" target="_blank" rel="noopener noreferrer">clickmusic.ro</a><br><br>
            <p style="font-size: 12px; color: #888888; text-align: center;">Dacă nu mai dorești să primești newslettere, te poți <a href="' . $unsubscribeUrl . '" style="color: #3869D4;">dezabona aici</a>.</p>'));
           
            }
}