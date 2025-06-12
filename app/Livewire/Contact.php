<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Livewire\Attributes\Validate;

class Contact extends Component
{
    #[Validate('required|min:2')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|min:5')]
    public $subject = '';

    #[Validate('required|min:10')]
    public $message = '';

    public $successMessage = '';
    public $isSubmitting = false;

    public function submitForm()
    {
        $this->isSubmitting = true;

        // Validează datele
        $this->validate();

        try {
            // Trimite email-ul
            Mail::to('contact@clickmusic.ro')->send(new ContactFormMail([
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject,
                'message' => $this->message,
            ]));

            // Resetează formularul
            $this->reset(['name', 'email', 'subject', 'message']);

            // Afișează mesajul de succes
            $this->successMessage = 'Mesajul a fost trimis cu succes! Vom răspunde în maxim 24 de ore.';

            // Ascunde mesajul după 5 secunde
            $this->dispatch('show-success-message');
        } catch (\Exception $e) {
            $this->addError('form', 'A apărut o eroare la trimiterea mesajului. Te rugăm să încerci din nou.');
        }

        $this->isSubmitting = false;
    }

    public function render()
    {
        return view('livewire.contact', [
            'title' => 'Contact - Click Music | Muzică Hip-Hop, Reggae, Soul',
            'description' => 'Contactează Click Music pentru întrebări, sugestii sau colaborări. Răspundem în maxim 24 de ore la toate mesajele.',
            'keywords' => 'contact Click Music, contact artist, colaborări muzicale, întrebări Click, suport Click Music',
            'ogTitle' => 'Contact Click Music - Întrebări și Colaborări',
            'ogDescription' => 'Ai întrebări despre muzică sau vrei să colaborezi? Contactează-ne și vom răspunde în cel mai scurt timp.',
            'canonicalUrl' => 'https://clickmusic.ro/contact',
            'bodyClass' => 'bg-black',
            'schemaMarkup' => '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "name": "Contact Click Music",
    "description": "Pagina de contact pentru artistul Click Music",
    "url": "https://clickmusic.ro/contact",
    "mainEntity": {
        "@type": "MusicGroup",
        "name": "Click",
        "genre": ["Hip-Hop", "Reggae", "Soul"],
        "url": "https://clickmusic.ro",
        "contactPoint": {
            "@type": "ContactPoint",
            "email": "contact@clickmusic.ro",
            "contactType": "Customer Service",
            "availableLanguage": "Romanian"
        }
    }
}
</script>'
        ]);
    }
}
