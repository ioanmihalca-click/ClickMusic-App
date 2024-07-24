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

    public function withDelay($notifiable)
    {
        return [
            'mail' => now()->addSeconds(2),
        ];
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
            ->line('Vă invit să ascultați piesa și să o luați în considerare pentru playlist-ul dumneavoastră.');


        $mailMessage->action('Ascultă/ Descarcă piesa', $this->songUrl);

        $mailMessage->line(new HtmlString("<br><br>Dacă doriți mai multe informații, nu ezitați să mă contactați la <a href='mailto:contact@clickmusic.ro'>contact@clickmusic.ro</a> sau la telefon 0734411115."))
            ->line('Vă mulțumesc pentru timpul acordat și pentru sprijinul acordat artiștilor români.');

        $salutation = new HtmlString('Cu respect,<br>Click<br><br>
            <a href="https://www.youtube.com/clickmusicromania" style="color: #DC2626; text-decoration: none;" target="_blank" rel="noopener noreferrer">YouTube Click Music</a> | 
            <a href="https://clickmusic.ro" style="color: #3B82F6; text-decoration: none;" target="_blank" rel="noopener noreferrer">clickmusic.ro</a>');

        $mailMessage->salutation($salutation);

        return $mailMessage;
    }
}
