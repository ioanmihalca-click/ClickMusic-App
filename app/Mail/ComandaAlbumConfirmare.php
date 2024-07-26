<?php

namespace App\Mail;

use App\Models\ComandaAlbum;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComandaAlbumConfirmare extends Mailable
{
    use Queueable, SerializesModels;

    public $comanda;

    public function __construct(ComandaAlbum $comanda)
    {
        $this->comanda = $comanda;
    }

    public function build()
    {
        return $this->subject('Confirmare comandă album')
                    ->markdown('emails.comenzi.confirmare');
    }
}
