<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class Newsletter extends Model
{
    use Notifiable;

    protected $fillable = [
        'recipient_email',
        'recipient_name',
        'status',
        'sent_at',
        'failed_at',
        'error_message',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'failed_at' => 'datetime',
    ];

    /**
     * Statusurile posibile pentru newsletter
     */
    const STATUS_PENDING = 'pending';
    const STATUS_SENT = 'sent';
    const STATUS_FAILED = 'failed';

    /**
     * Returnează adresa de email pentru notificări
     */
    public function routeNotificationForMail($notification)
    {
        return $this->recipient_email;
    }

    /**
     * Scope pentru newslettere cu status pending
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope pentru newslettere trimise
     */
    public function scopeSent(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_SENT);
    }

    /**
     * Scope pentru newslettere eșuate
     */
    public function scopeFailed(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_FAILED);
    }

    /**
     * Scope pentru newslettere trimise astăzi
     */
    public function scopeSentToday(Builder $query): Builder
    {
        return $query->whereDate('sent_at', Carbon::today())
            ->where('status', self::STATUS_SENT);
    }

    /**
     * Returnează numărul de newslettere trimise astăzi
     */
    public static function getSentTodayCount(): int
    {
        return static::sentToday()->count();
    }

    /**
     * Verifică dacă s-a atins limita zilnică
     */
    public static function isDailyLimitReached(int $limit = 200): bool
    {
        return static::getSentTodayCount() >= $limit;
    }

    /**
     * Returnează câte newslettere mai pot fi trimise astăzi
     */
    public static function getRemainingQuota(int $limit = 200): int
    {
        return max(0, $limit - static::getSentTodayCount());
    }

    /**
     * Marchează newsletter-ul ca trimis
     */
    public function markAsSent(): bool
    {
        return $this->update([
            'status' => self::STATUS_SENT,
            'sent_at' => now(),
            'failed_at' => null,
            'error_message' => null,
        ]);
    }

    /**
     * Marchează newsletter-ul ca eșuat
     */
    public function markAsFailed(string $errorMessage = null): bool
    {
        return $this->update([
            'status' => self::STATUS_FAILED,
            'failed_at' => now(),
            'error_message' => $errorMessage,
        ]);
    }

    /**
     * Resetează statusul la pending
     */
    public function resetToPending(): bool
    {
        return $this->update([
            'status' => self::STATUS_PENDING,
            'sent_at' => null,
            'failed_at' => null,
            'error_message' => null,
        ]);
    }

    /**
     * Returnează label-ul pentru status în română
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'În așteptare',
            self::STATUS_SENT => 'Trimis',
            self::STATUS_FAILED => 'Eșuat',
            default => $this->status,
        };
    }

    /**
     * Returnează culoarea pentru status
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_SENT => 'success',
            self::STATUS_FAILED => 'danger',
            default => 'primary',
        };
    }
}
