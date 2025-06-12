<?php

namespace App\Livewire;

use Livewire\Component;

class ElectronicPressKit extends Component
{
  public $activeSection = 'overview';

  public $sections = [
    'overview' => [
      'title' => 'Overview',
      'component' => 'epk.artist-overview'
    ],
    'biography' => [
      'title' => 'Biografie',
      'component' => 'epk.biography-section'
    ],
    'discography' => [
      'title' => 'Discografie',
      'component' => 'epk.discography-section'
    ],
    'drum-bass-project' => [
      'title' => 'Proiect 2025',
      'component' => 'epk.drum-bass-project'
    ],
    'media-assets' => [
      'title' => 'Media Assets',
      'component' => 'epk.media-assets'
    ],
    'contact-booking' => [
      'title' => 'Contact',
      'component' => 'epk.contact-booking'
    ],
    'download' => [
      'title' => 'Download',
      'component' => 'epk.download-section'
    ],
    'future-vision' => [
      'title' => 'Viziune',
      'component' => 'epk.future-vision'
    ]
  ];

  public function setActiveSection($section)
  {
    if (array_key_exists($section, $this->sections)) {
      $this->activeSection = $section;
    }
  }

  public function render()
  {
    return view('livewire.electronic-press-kit', [
      'title' => 'Electronic Press Kit - Click Music | Hip-Hop, Reggae, Soul',
      'description' => 'Electronic Press Kit oficial al artistului Click - 23 ani de experiență, 50+ milioane vizualizări, proiect Drum & Bass 2025. Materiale complete pentru media și booking.',
      'keywords' => 'Click Music EPK, Electronic Press Kit, press kit artist român, booking Click, media assets, biografia Click, discografie Click Music, proiect drum bass 2025',
      'ogTitle' => 'Electronic Press Kit - Click Music | Artist Hip-Hop, Drum & Bass, Reggae',
      'ogDescription' => 'EPK oficial Click Music: biografia artistului, discografia completă, realizări, contact booking și materiale media pentru presă.',
      'canonicalUrl' => 'https://clickmusic.ro/electronic-press-kit',
      'bodyClass' => 'bg-black',
      'schemaMarkup' => '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CreativeWork",
  "name": "Electronic Press Kit - Click Music",
  "description": "Kit oficial de presă pentru artistul Click - informații complete, biografii, discografie și materiale media",
  "author": {
    "@type": "MusicGroup",
    "name": "Click",
    "description": "Artist hip-hop, drum & bass si reggae cu peste 2 decenii de experiență",
    "genre": ["Hip-Hop", "Reggae", "Drum & Bass"],
    "url": "https://clickmusic.ro",
    "foundingDate": "2001",
    "foundingLocation": {
      "@type": "Place",
      "name": "Baia Mare, Maramureș, România"
    },
    "sameAs": [
      "https://youtube.com/clickmusicromania",
      "https://instagram.com/clickmusic1",
      "https://facebook.com/clickmusicromania"
    ],
    "contactPoint": {
      "@type": "ContactPoint",
      "email": "contact@clickmusic.ro",
      "contactType": "Media Relations"
    }
  },
  "datePublished": "' . date('Y-m-d') . '",
  "url": "https://clickmusic.ro/electronic-press-kit"
}
</script>'
    ]);
  }
}
