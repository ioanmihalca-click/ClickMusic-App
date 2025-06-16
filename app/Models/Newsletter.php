<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        // Câmpuri pentru campaniile
        'campaign_title',
        'campaign_subject',
        'campaign_content',
        'campaign_type',
        'scheduled_at',
        'recipients_count',
        'sent_count',
        'failed_count',
        'created_by',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'failed_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'recipients_count' => 'integer',
        'sent_count' => 'integer',
        'failed_count' => 'integer',
        'created_by' => 'integer',
    ];

    /**
     * Tipurile de newsletter
     */
    const TYPE_SUBSCRIBER = 'subscriber';  // Adresă de email adăugată manual
    const TYPE_CAMPAIGN = 'campaign';      // Campanie de newsletter

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
     * Scope pentru campaniile de newsletter
     */
    public function scopeCampaigns(Builder $query): Builder
    {
        return $query->where('campaign_type', self::TYPE_CAMPAIGN);
    }

    /**
     * Scope pentru abonații simpli
     */
    public function scopeSubscribers(Builder $query): Builder
    {
        return $query->where('campaign_type', self::TYPE_SUBSCRIBER);
    }

    /**
     * Scope pentru campaniile draft
     */
    public function scopeDraftCampaigns(Builder $query): Builder
    {
        return $query->campaigns()->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope pentru campaniile programate
     */
    public function scopeScheduledCampaigns(Builder $query): Builder
    {
        return $query->campaigns()
            ->where('status', self::STATUS_PENDING)
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '>', now());
    }

    /**
     * Verifică dacă este o campanie
     */
    public function isCampaign(): bool
    {
        return $this->campaign_type === self::TYPE_CAMPAIGN;
    }

    /**
     * Verifică dacă este un subscriber simplu
     */
    public function isSubscriber(): bool
    {
        return $this->campaign_type === self::TYPE_SUBSCRIBER;
    }

    /**
     * Verifică dacă campania poate fi editată
     */
    public function canBeEdited(): bool
    {
        return $this->isCampaign() &&
            $this->status === self::STATUS_PENDING;
    }

    /**
     * Verifică dacă campania poate fi trimisă
     */
    public function canBeSent(): bool
    {
        return $this->isCampaign() &&
            $this->status === self::STATUS_PENDING &&
            !empty($this->campaign_subject) &&
            !empty($this->campaign_content);
    }

    /**
     * Programează campania pentru trimitere
     */
    public function scheduleCampaign(\DateTime $scheduledAt): bool
    {
        return $this->update([
            'scheduled_at' => $scheduledAt,
        ]);
    }

    /**
     * Actualizează statisticile campaniei
     */
    public function updateCampaignStats(int $sentCount, int $failedCount): bool
    {
        return $this->update([
            'sent_count' => $sentCount,
            'failed_count' => $failedCount,
        ]);
    }

    /**
     * Returnează conținutul cu variabilele înlocuite
     */
    public function getProcessedContent(array $variables = []): string
    {
        if (!$this->isCampaign()) {
            return '';
        }

        $content = $this->campaign_content;

        // Variabile default disponibile în toate campaniile
        $defaultVariables = [
            '{{site_name}}' => config('app.name', 'Click Music'),
            '{{site_url}}' => config('app.url'),
            '{{year}}' => date('Y'),
            '{{current_date}}' => now()->format('d/m/Y'),
        ];

        // Combină variabilele default cu cele custom
        $allVariables = array_merge($defaultVariables, $variables);

        // Înlocuiește variabilele în conținut
        foreach ($allVariables as $variable => $value) {
            $content = str_replace($variable, $value, $content);
        }

        return $content;
    }

    /**
     * Scope pentru newslettere cu status pending (doar subscribers)
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->subscribers()->where('status', self::STATUS_PENDING);
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
     * Creează o nouă campanie
     */
    public static function createCampaign(array $data): self
    {
        return static::create([
            'campaign_title' => $data['title'],
            'campaign_subject' => $data['subject'],
            'campaign_content' => $data['content'],
            'campaign_type' => self::TYPE_CAMPAIGN,
            'status' => self::STATUS_PENDING,
            'recipients_count' => $data['recipients_count'] ?? 0,
            'scheduled_at' => $data['scheduled_at'] ?? null,
            'created_by' => $data['created_by'] ?? Auth::id(),
            // Pentru campaniile setăm valori dummy UNICE
            'recipient_email' => 'campaign-' . time() . '-' . rand(1000, 9999) . '@internal.local',
            'recipient_name' => $data['title'],
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

    /**
     * Verifică dacă newsletter-ul este dezabonat (analog cu User->unsubscribed)
     */
    public function getUnsubscribedAttribute(): bool
    {
        return $this->status !== self::STATUS_PENDING;
    }
}
