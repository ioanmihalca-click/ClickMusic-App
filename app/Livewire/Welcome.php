<?php

namespace App\Livewire;

use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        return view('livewire.welcome', [
            'title' => 'Click Music - Hip-Hop, Drum & Bass, Reggae - Electronic Press Kit, Magazin, Blog',
            'description' => 'Click Music - Muzica, Hip-Hop, Drum & Bass, Reggae - Electronic Press Kit, Magazin, Blog',
            'keywords' => 'Click, Click Music, muzică românească, hip hop românesc, drum & bass reggae românesc, Baia Mare, Maramureș, artist independent, streaming muzică, albume digitale, videoclipuri muzicale, download MP3, concerte Click, versuri Click, muzică nouă, muzică underground, muzică alternativă, muzică independentă, muzică conștientă, muzică pozitivă, muzică de vară, muzică de petrecere, muzică de relaxare, artist reggae din România, albume hip-hop de ascultat în 2024, muzică pentru relaxare',
            'ogTitle' => 'Click Music - Muzica, Hip-Hop, Drum & Bass, Reggae - Electronic Press Kit, Magazin, Blog',
            'ogDescription' => 'Click Music - Muzica, Hip-Hop, Drum & Bass, Reggae - Electronic Press Kit, Magazin, Blog',
            'canonicalUrl' => 'https://clickmusic.ro',
            'bodyClass' => 'bg-white',
            'schemaMarkup' => '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MusicArtist",
  "name": "Click",
  "description": "Click este un artist de muzică hip-hop, drum & bass si reggae din Romania.",
  "genre": ["Hip-Hop", "Drum & Bass", "Reggae"],
  "url": "https://clickmusic.ro",
  "image": "' . asset('img/ClickMusic-OG-Site.jpg') . '",
  "sameAs": [
    "https://youtube.com/clickmusicromania"
  ],
  "album": [
    {
      "@type": "MusicAlbum",
      "name": "Trup și Suflet",
      "datePublished": "2017"
    },
    {
      "@type": "MusicAlbum",
      "name": "Lume Dragă",
      "datePublished": "2020"
    },
    {
      "@type": "MusicAlbum",
      "name": "Dulce și Amar",
      "albumProductionType": "EP",
      "datePublished": "2021"
    },
    {
      "@type": "MusicAlbum",
      "name": "Culori EP",
      "albumProductionType": "EP",
      "datePublished": "2021",
      "byArtist": [
        {
          "@type": "MusicArtist",
          "name": "Click"
        },
        {
          "@type": "MusicArtist",
          "name": "MdBeatz"
        }
      ]
    },
    {
      "@type": "MusicAlbum",
      "name": "Inima Romana",
      "datePublished": "2024",
      "byArtist": [
        {
          "@type": "MusicArtist",
          "name": "Click"
        },
        {
          "@type": "MusicArtist",
          "name": "Găvrilă"
        }
      ]
    }
  ]
}
</script>'
        ]);
    }
}
