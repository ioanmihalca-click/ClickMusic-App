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
    protected $subject;
    protected $content;

    public function __construct(Newsletter $newsletter, $subject, $content)
    {
        $this->newsletter = $newsletter;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function withDelay($notifiable)
    {
        return [
            'mail' => now()->addSeconds(2),
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('contact@clickmusic.ro', 'Click Music Ro')
            ->subject($this->subject)
            ->greeting('Salut ' . $this->newsletter->recipient_name)
            ->line(new HtmlString($this->content))
            ->salutation(new HtmlString('Cu respect,<br>Click<br><br>
                <a href="https://www.youtube.com/clickmusicromania" style="color: #DC2626; text-decoration: none;" target="_blank" rel="noopener noreferrer">YouTube Click Music</a> | 
                <a href="https://clickmusic.ro" style="color: #3B82F6; text-decoration: none;" target="_blank" rel="noopener noreferrer">clickmusic.ro</a>'));
    }
}