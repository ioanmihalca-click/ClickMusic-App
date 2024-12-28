<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Click Music - Magazin | Albume</title>

    <!-- Meta Tags -->
    <meta name="description"
        content="Descoperă albumele artistului Click - muzică hip-hop, reggae și soul autentică din inima României. Streaming și achiziție de albume digitale.">
    <meta name="keywords" content="Click Music, hip-hop românesc, soul, reggae, albume muzicale, artist român, Baia Mare">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Click Music - Albume Hip-Hop, Reggae și Soul">
    <meta property="og:description"
        content="Explorează colecția de albume a artistului Click - hip-hop, reggae și soul direct din inima României.">
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG-Magazin.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <link rel="canonical" href="https://clickmusic.ro/magazin" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

<style>
        /* Custom scrollbar styling */
        body::-webkit-scrollbar {
            width: 9px;
        }

        body::-webkit-scrollbar-thumb {
            background-color: #3B82F6;
            border-radius: 3px;
        }

        body::-webkit-scrollbar-track {
            background-color: #d1d5db;
            border-radius: 3px;
        }
    </style>

<script type="application/ld+json">
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
    "description": "Click este un artist de muzică hip-hop și reggae din Baia-Mare, Maramureș.",
    "genre": ["Hip-Hop", "Reggae", "Soul"],
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
</script>



    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-34NT57GG5F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-34NT57GG5F');
    </script>
</head>

<body class="font-sans antialiased bg-black">

<livewire:header-nav />

<main class="container px-4 py-8 mx-auto">
    <!-- Header cu gradient și efect de glow -->
    <div class="relative">
        <!-- Gradient blur în fundal -->
        <div class="absolute inset-0 blur-3xl opacity-30">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
        </div>

        <div class="relative z-10 px-6 mt-24 mb-12">
            <h1 class="text-4xl font-bold tracking-[0.2em] text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 uppercase font-roboto-condensed">
                Albume
            </h1>
            <div class="w-24 h-1 mx-auto mt-2 rounded-full bg-gradient-to-r from-blue-500 to-transparent"></div>
        </div>
    </div>

    @if(session('error'))
        <div class="relative px-4 py-3 text-green-700 border rounded-lg bg-green-100/10 backdrop-blur-sm border-green-400/50" role="alert">
            <strong class="font-bold">Eroare:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif


   
           
                <livewire:album-list />
            
      
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>
