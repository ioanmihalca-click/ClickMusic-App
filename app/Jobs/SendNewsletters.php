<?php

namespace App\Jobs;

use Carbon\Carbon;
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
    $today = Carbon::today();

    $this->newsletters->chunk(100)->each(function (Collection $chunk) use ($today) {
        if (Newsletter::where('status', 'sent')->whereDate('sent_at', $today)->count() >= 300) {
            $this->release(3600); 
            return;
        }

        foreach ($chunk as $newsletter) { // Move the foreach loop inside the chunk processing
            try {
                $newsletter->notify(new NewsletterNotification($newsletter, $this->imageUrl, $this->url));

                $newsletter->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);

                sleep(5);

            } catch (\Exception $e) {
                // Now $newsletter is defined within the catch block
                logger()->error("Error sending newsletter (chunk {$chunk->count()}) to {$newsletter->recipient_email}: {$e->getMessage()}");
            }
        } 
    });
}

}
