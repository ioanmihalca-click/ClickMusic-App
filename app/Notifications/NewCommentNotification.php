<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCommentNotification extends Notification 
{
    use Queueable;

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['mail']; 
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('contact@clickmusic.ro', 'Click Music Ro')
            ->greeting('Salut Admin')
            ->subject('Un nou comment la videoclipul tau')
            ->line($this->comment->user->name . ' a lasat un comment la videoclipul tau: ' . $this->comment->video->title)
            ->line($this->comment->body)
            ->action('Vezi Comment', url('/videos/' . $this->comment->video->id))      
            ->salutation('Cu respect, Click Music App');
    }
}
