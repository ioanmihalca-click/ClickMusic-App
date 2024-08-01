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

    protected Collection $newsletters; 
    protected $imageUrl;
    protected $url;

    public function __construct(Collection $newsletters, $imageUrl, $url)
    {
        $this->newsletters = $newsletters;
        $this->imageUrl = $imageUrl;
        $this->url = $url;
    }

    public function handle()
    {
        foreach ($this->newsletters as $newsletter) {
            try {
                $newsletter->notify(new NewsletterNotification($newsletter, $this->imageUrl, $this->url));

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
