<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use App\Models\PromoEmail;

class PromoEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $promoEmail;
    protected $songUrl;
    protected $downloadUrl;
    protected $imageUrl;
    protected $subject;

    public function __construct(PromoEmail $promoEmail, $songUrl, $downloadUrl = null, $imageUrl = null, $subject = null)
    {
        $this->promoEmail = $promoEmail;
        $this->songUrl = $songUrl;
        $this->downloadUrl = $downloadUrl;
        $this->imageUrl = $imageUrl;
        $this->subject = $subject ?? 'Noua piesă de la Click';
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->from('contact@clickmusic.ro', 'Click Music Ro')
            ->subject($this->subject)
            ->greeting('Salut ' . $this->promoEmail->recipient_name . ',')
            ->line('Sper că acest email vă găsește bine. Sunt Click, un artist de muzică hip hop reggae din România. Am lansat o nouă piesă pe care vreau să v-o prezint.')
            ->line(new HtmlString("Titlul piesei: <strong>{$this->subject}</strong>"))
            ->line(new HtmlString("<a href='" . asset($this->songUrl) . "'><img src='" . asset($this->imageUrl) . "' alt='Cover-ul piesei'></a>"))
            ->line('Vă rog să ascultați piesa și să o luați în considerare pentru playlist-ul dumneavoastră.');

        // Acțiune "Ascultă piesa" (link extern)
        $mailMessage->action('Ascultă piesa', $this->songUrl);

        // Acțiune "Descarcă piesa" (doar dacă există URL de descărcare)
        if ($this->downloadUrl) {
            $mailMessage->action('Descarcă piesa', asset($this->downloadUrl));
        }

        $mailMessage->line(new HtmlString("<br><br>Dacă doriți mai multe informații sau materiale promoționale, nu ezitați să mă contactați la <a href='mailto:contact@clickmusic.ro'>contact@clickmusic.ro</a>."))
            ->line('Vă mulțumesc pentru timpul acordat și pentru sprijinul acordat artiștilor români.')
            ->salutation('Cu respect, Click');

        return $mailMessage;
    }
}
