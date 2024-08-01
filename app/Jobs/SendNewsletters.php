<?php

namespace App\Jobs;

use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewsletterNotification;

class SendNewsletters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $newsletters;
    protected $subject;
    protected $content;

    public function __construct($newsletters, $subject, $content)
    {
        $this->newsletters = $newsletters;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function handle()
    {
        if (!$this->newsletters instanceof Collection) {
            $this->newsletters = collect([$this->newsletters]);
        }

        foreach ($this->newsletters as $newsletter) {
            try {
                Notification::send($newsletter, new NewsletterNotification(
                    $newsletter,
                    $this->subject,
                    $this->content
                ));

                $newsletter->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                $newsletter->update(['status' => 'failed']);
                logger()->error("Error sending newsletter to {$newsletter->recipient_email}: {$e->getMessage()}");
            }
        }
    }
}