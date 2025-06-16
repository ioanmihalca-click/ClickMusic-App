<?php

namespace App\Livewire;

use Livewire\Component;

class Magazin extends Component
{
  public $activeTab = 'toate';

  public function setActiveTab($tab)
  {
    $this->activeTab = $tab;
  }

  public function render()
  {
    return view('livewire.magazin', [
      'activeTab' => $this->activeTab,
      'title' => 'Click Music - Magazin | Albume și Haine',
      'description' => 'Descoperă albumele și hainele artistului Click - muzică hip-hop,drum & bass si reggae din inima României. Streaming, achiziție de albume digitale și haine oficiale.',
      'keywords' => 'Click Music, hip-hop românesc, soul, reggae, albume muzicale, haine, tricouri, hanorace, artist român, Baia Mare',
      'ogTitle' => 'Click Music - Magazin Oficial',
      'ogDescription' => 'Explorează colecția de albume și haine a artistului Click - hip-hop, drum & bass si reggae direct din inima României.',
      'ogImage' => asset('img/ClickMusic-OG-Magazin.jpg'),
      'canonicalUrl' => 'https://clickmusic.ro/magazin',
      'bodyClass' => 'bg-black',
      'mainClass' => 'container px-4 py-8 mx-auto',
      'schemaMarkup' => '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Store",
  "name": "Click Music",
  "image": "https://clickmusic.ro/img/ClickMusic-OG-Site.jpg",
  "url": "https://clickmusic.ro/magazin",
  "description": "Magazinul oficial al artistului Click, unde poți găsi albume digitale și haine oficiale.",
  "brand": {
    "@type": "Brand",
    "name": "Click Music"
  },
  "sameAs": [
    "https://youtube.com/clickmusicromania",
    "https://www.facebook.com/clickmusicromania",
    "https://www.instagram.com/clickmusic1/"
  ],
  "knowsAbout": {
    "@type": "MusicGroup",
    "name": "Click",
    "description": "Click este un artist de muzică hip-hop, drum & bass și reggae din Baia-Mare, Maramureș.",
    "genre": ["Hip-Hop", "Drum & Bass", "Reggae"],
    "url": "https://clickmusic.ro",
    "image": "https://clickmusic.ro/img/ClickMusic-OG-Magazin.jpg",
    "sameAs": [
      "https://youtube.com/clickmusicromania"
    ]
  }
}
</script>'
    ]);
  }
}
