<?php

namespace App\Livewire;

use Livewire\Component;

class Magazin extends Component
{
    public function render()
    {
        return view('livewire.magazin', [
            'title' => 'Click Music - Magazin | Albume',
            'description' => 'Descoperă albumele artistului Click - muzică hip-hop,drum & bass si reggae din inima României. Streaming și achiziție de albume digitale.',
            'keywords' => 'Click Music, hip-hop românesc, soul, reggae, albume muzicale, artist român, Baia Mare',
            'ogTitle' => 'Click Music - Albume Hip-Hop,drum & bass si reggae',
            'ogDescription' => 'Explorează colecția de albume a artistului Click - hip-hop, drum & bass si reggae direct din inima României.',
            'ogImage' => asset('img/ClickMusic-OG-Magazin.jpg'),
            'canonicalUrl' => 'https://clickmusic.ro/magazin',
            'bodyClass' => 'bg-black',
            'mainClass' => 'container px-4 py-8 mx-auto',
            'schemaMarkup' => '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MusicStore",
  "name": "Click Music",
  "image": "https://clickmusic.ro/img/ClickMusic-OG-Site.jpg",
  "url": "https://clickmusic.ro/magazin",
  "description": "Magazinul oficial al artistului Click, unde poți găsi albume digitale și tricouri.",
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
  },
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "item": {
        "@type": "MusicAlbum",
        "name": "Trup și Suflet",
        "byArtist": {
          "@type": "MusicGroup",
          "name": "Click"
        },
        "image": "https://clickmusic.ro/storage/albume/coperte/01J41ZS2EGHTMYBTV1579HBY0M.png",
        "datePublished": "2017-11-24",
        "genre": "Hip Hop, Reggae, Soul",
        "numTracks": 24,
        "offers": {
          "@type": "Offer",
          "price": "35.99",
          "priceCurrency": "RON",
          "url": "https://clickmusic.ro/album/trup-si-suflet",
          "availability": "https://schema.org/InStock"
        }
      }
    },
    {
      "@type": "ListItem",
      "position": 2,
      "item": {
        "@type": "MusicAlbum",
        "name": "Lume Dragă",
        "byArtist": {
          "@type": "MusicGroup",
          "name": "Click"
        },
        "image": "https://clickmusic.ro/storage/albume/coperte/01J420HTMWVRJQBFXEQ0AFBY85.jpg",
        "datePublished": "2020-11-24",
        "genre": "Hip Hop, Reggae, Soul",
        "numTracks": 27,
        "offers": {
          "@type": "Offer",
          "price": "35.99",
          "priceCurrency": "RON",
          "url": "https://clickmusic.ro/album/lume-draga",
          "availability": "https://schema.org/InStock"
        }
      }
    },
    {
      "@type": "ListItem",
      "position": 3,
      "item": {
        "@type": "MusicAlbum",
        "name": "Dulce și Amar",
        "byArtist": {
          "@type": "MusicGroup",
          "name": "Click"
        },
        "image": "https://clickmusic.ro/storage/albume/coperte/01J41VW85010WQGXNRBBNJGHDW.jpg",
        "datePublished": "2018-01-01",
        "albumProductionType": "EP",
        "genre": "Hip Hop, Soul",
        "numTracks": 8,
        "offers": {
          "@type": "Offer",
          "price": "25.99",
          "priceCurrency": "RON",
          "url": "https://clickmusic.ro/album/dulce-si-amar-ep",
          "availability": "https://schema.org/InStock"
        }
      }
    },
    {
      "@type": "ListItem",
      "position": 4,
      "item": {
        "@type": "MusicAlbum",
        "name": "Culori EP",
        "byArtist": [
          {
            "@type": "MusicArtist",
            "name": "Click"
          },
          {
            "@type": "MusicArtist",
            "name": "MdBeatz"
          }
        ],
        "image": "https://clickmusic.ro/storage/albume/coperte/01J41Z5VQFSCJ2ZGK8SXR7WWG7.jpg",
        "datePublished": "2021-06-15",
        "albumProductionType": "EP",
        "genre": "Hip Hop",
        "numTracks": 7,
        "offers": {
          "@type": "Offer",
          "price": "25.99",
          "priceCurrency": "RON",
          "url": "https://clickmusic.ro/album/culori-ep",
          "availability": "https://schema.org/InStock"
        }
      }
    },
   {
            "@type": "ListItem",
            "position": 5,
            "item": {
                "@type": "MusicAlbum",
                "name": "Inima Română",
                "byArtist": [
                    {
                        "@type": "MusicArtist",
                        "name": "Click"
                    },
                    {
                        "@type": "MusicArtist",
                        "name": "Găvrilă"
                    }
                ],
                "datePublished": "2024-12-01" 
               
            }
        }
    ]
}
</script>'
        ]);
    }
}
