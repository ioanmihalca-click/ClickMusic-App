<?php

namespace App\Jobs;

use App\Models\PromoEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PromoEmailNotification;

class SendPromoEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emails;
    protected $songUrl;
    protected $imageUrl;
    protected $songTitle;

    public function __construct($emails, $songTitle, $songUrl, $imageUrl = null)
    {
        $this->emails = $emails;
        $this->songTitle = $songTitle;
        $this->songUrl = $songUrl;
        $this->imageUrl = $imageUrl;
    }

    public function handle()
    {
        if (! $this->emails instanceof Collection) {
            $this->emails = collect([$this->emails]);
        }

        foreach ($this->emails as $email) {
            try {
                Notification::send($email, new PromoEmailNotification(
                    $email,
                    $this->songUrl,
                    $this->imageUrl,
                    $this->songTitle
                ));

                // Actualizarea statusului emailului
                $email->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                $email->update(['status' => 'failed']);
                logger()->error("Error sending email to {$email->recipient_email}: {$e->getMessage()}");
            }
        }
    }
}