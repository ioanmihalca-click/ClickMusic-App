<?php

namespace App\Mail;

use App\Models\ComandaHaina;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComandaHainaConfirmare extends Mailable
{
    use Queueable, SerializesModels;

    public $comandaHaina;

    /**
     * Create a new message instance.
     */
    public function __construct(ComandaHaina $comandaHaina)
    {
        $this->comandaHaina = $comandaHaina;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmarea comenzii pentru ' . $this->comandaHaina->haina->nume,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.comanda-haina-confirmare',
            with: [
                'comandaHaina' => $this->comandaHaina,
                'haina' => $this->comandaHaina->haina,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
