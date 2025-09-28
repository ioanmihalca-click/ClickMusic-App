<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DailyEmailTracker extends Model
{
    protected $fillable = ['date', 'emails_sent', 'email_type'];

    protected $dates = ['date'];

    /**
     * Get today's email count
     */
    public static function getTodayEmailCount(): int
    {
        return static::whereDate('date', Carbon::today())
            ->sum('emails_sent');
    }

    /**
     * Check if we can send more emails today
     */
    public static function canSendEmails(int $count = 1): bool
    {
        $dailyLimit = config('mail.daily_limit', 100);
        $todayCount = static::getTodayEmailCount();

        return ($todayCount + $count) <= $dailyLimit;
    }

    /**
     * Get remaining email quota for today
     */
    public static function getRemainingQuota(): int
    {
        $dailyLimit = config('mail.daily_limit', 100);
        $todayCount = static::getTodayEmailCount();

        return max(0, $dailyLimit - $todayCount);
    }

    /**
     * Record sent emails
     */
    public static function recordSentEmails(int $count, string $type = 'video_notification'): void
    {
        $today = Carbon::today();

        $tracker = static::firstOrCreate(
            [
                'date' => $today,
                'email_type' => $type
            ],
            ['emails_sent' => 0]
        );

        $tracker->increment('emails_sent', $count);
    }
}