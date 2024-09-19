<?php

namespace App\Jobs;

use Exception; 
use Carbon\Carbon;
use App\Models\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;
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
    $maxDailySent = 300;
    $errorCount = 0;
    $maxErrors = 10;

    Log::info("Starting SendNewsletters job");

    if (Newsletter::whereDate('sent_at', $today)->where('status', 'sent')->count() >= $maxDailySent) {
        Log::info("Daily limit reached. Releasing job.");
        $this->release(3600);
        return;
    }

    $this->newsletters->chunk(100)->each(function (Collection $chunk) use ($today, $maxDailySent, &$errorCount, $maxErrors) {
        Log::info("Processing chunk of {$chunk->count()} newsletters");

        foreach ($chunk as $newsletter) {
            try {
                if (Newsletter::whereDate('sent_at', $today)->where('status', 'sent')->count() >= $maxDailySent) {
                    Log::info("Daily limit reached during processing. Releasing job.");
                    $this->release(3600);
                    return false;
                }

                $newsletter->notify(new NewsletterNotification($newsletter, $this->imageUrl, $this->url));

                $newsletter->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);

                Log::info("Newsletter sent to {$newsletter->recipient_email}");

                sleep(10);
                DB::connection()->reconnect();

            } catch (Exception $e) {
                $errorCount++;
                Log::error("Error sending newsletter to {$newsletter->recipient_email}: {$e->getMessage()}");

                if ($errorCount > $maxErrors) {
                    Log::error("Max error count reached. Stopping job.");
                    throw $e;
                }
            }
        }
    });

    Log::info("SendNewsletters job completed");
}
}
