<?php

namespace App\Notifications;

use App\Models\ForumReply;
use App\Models\ForumThread;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForumReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reply;
    protected $thread;

    /**
     * Create a new notification instance.
     */
    public function __construct(ForumReply $reply, ForumThread $thread)
    {
        $this->reply = $reply;
        $this->thread = $thread;
    }

    /**
     * Get the notification's delivery channels.
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
        $replyUser = User::find($this->reply->user_id);
        $threadUrl = route('forum.threads.show', $this->thread);

        return (new MailMessage)
            ->subject("Răspuns nou în discuția: {$this->thread->title}")
            ->greeting("Salut {$notifiable->name},")
            ->line("{$replyUser->name} a răspuns în discuția la care participi:")
            ->line("**{$this->thread->title}**")
            ->line("----------")
            ->line($this->getExcerpt($this->reply->content))
            ->line("----------")
            ->action('Vezi discuția', $threadUrl)
            ->line('Primești această notificare deoarece ești autorul discuției sau ai participat anterior în această discuție.');
    }

    /**
     * Get an excerpt of the reply content.
     */
    protected function getExcerpt(string $content, int $length = 200): string
    {
        $plainText = strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $content));

        if (strlen($plainText) <= $length) {
            return $plainText;
        }

        return substr($plainText, 0, $length) . '...';
    }
}
