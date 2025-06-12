<?php

namespace App\Livewire;

use Livewire\Component;

class AccesPremium extends Component
{
    public function render()
    {
        return view('livewire.acces-premium', [
            'title' => 'Click Music - Acces Premium | Abonament',
            'description' => 'Abonează-te la Click Music Premium pentru acces exclusiv la videoclipuri, piese noi și conținut premium. Doar 9,99 lei/lună.',
            'keywords' => 'Click Music Premium, abonament muzică, videoclipuri exclusive, content premium, streaming muzică românească, hip-hop premium',
            'ogTitle' => 'Click Music - Acces Premium | Abonament Exclusiv',
            'ogDescription' => 'Intră în comunitatea Click Music Premium și bucură-te de acces exclusiv la conținut premium.',
            'canonicalUrl' => 'https://clickmusic.ro/accespremium',
            'bodyClass' => 'bg-black',
            'mainClass' => 'container py-20 mx-auto',
            'schemaMarkup' => '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Offer",
  "name": "Click Music Premium",
  "description": "Abonament premium pentru acces exclusiv la videoclipuri și conținut muzical.",
  "price": "9.99",
  "priceCurrency": "RON",
  "availability": "https://schema.org/InStock",
  "seller": {
    "@type": "MusicGroup",
    "name": "Click",
    "url": "https://clickmusic.ro"
  },
  "category": "Music Subscription",
  "validFrom": "' . date('Y-m-d') . '"
}
</script>'
        ]);
    }
}
