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
            <h1 class="text-4xl font-bold tracking-[0.2em] text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 uppercase font-roboto-condensed">
                Albume
            </h1>
            <div class="w-24 h-1 mt-2 rounded-full bg-gradient-to-r from-blue-500 to-transparent"></div>
        </div>
    </div>

    @if(session('error'))
        <div class="relative px-4 py-3 text-green-700 border rounded-lg bg-green-100/10 backdrop-blur-sm border-green-400/50" role="alert">
            <strong class="font-bold">Eroare:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif


   
            <div class="p-6">
                <livewire:album-list />
            </div>
      
    </main>

    <footer class="py-8 text-white bg-gray-800">
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap justify-between">
                <div class="w-full mb-6 md:w-1/3 md:mb-0">
                    <h3 class="mb-2 text-xl font-bold">Click Music</h3>
                    <p class="text-gray-400">Hip-Hop, Reggae și Soul din inima României</p>
                </div>
                <div class="w-full mb-6 md:w-1/3 md:mb-0">
                    <h3 class="mb-2 text-xl font-bold">Link-uri rapide</h3>
                    <ul class="text-gray-400">
                        <li><a href="{{ route('privacy-policy') }}" class="hover:text-white">Politica de
                                confidențialitate</a></li>
                        <li><a href="{{ route('terms-of-service') }}" class="hover:text-white">Termeni și Condiții</a>
                        </li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/3">
                    <h3 class="mb-3 text-xl font-bold">Mă găsesti și aici:</h3>
                    <div class="flex mx-auto space-x-4">
                        <a href="https://instagram.com/clickmusic1" target="_blank" rel="noopener noreferrer"
                            class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                class="" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                            </svg>
                        </a>

                        <a href="https://www.facebook.com/clickmusicromania" target="_blank" rel="noopener noreferrer"
                            class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                class="" viewBox="0 0 16 16">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                            </svg>
                        </a>

                        <a href="https://open.spotify.com/artist/0rbyxJSUfSXjmeW652c41O?si=4I3hPlSITruYO69znEmXFA&nd=1&dlsi=cf9e5847f277482e"
                            target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                class="" viewBox="0 0 16 16">
                                <path
                                    d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288" />
                            </svg>
                        </a>

                        <a href="https://youtube.com/clickmusicromania" target="_blank" rel="noopener noreferrer"
                            class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                fill="currentColor" class="" viewBox="0 0 16 16">
                                <path
                                    d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                            </svg>
                        </a>

                    </div>
                </div>
            </div>
            <div class="mt-8 text-sm text-center text-gray-400">
                <p>&copy; {{ date('Y') }} ClickMusic. Toate drepturile rezervate.</p>
                <p class="mt-2">Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank"
                        rel="noopener noreferrer" class="text-blue-300 hover:text-white">Click Studios Digital</a>.
                </p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>

</html>
