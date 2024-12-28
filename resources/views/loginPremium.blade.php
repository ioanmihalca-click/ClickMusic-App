<!DOCTYPE html>
<html lang="ro">

<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-34NT57GG5F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-34NT57GG5F');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta Tags for Click Music Streaming App -->
    <meta name="description"
        content="Click Music - Muzica, Hip-Hop, Reggae, Soul - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta name="keywords"
        content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video, videoclipuri exclusive" />

    <!-- Open Graph Tags for Social Media Sharing -->
    <meta property="og:title" content="Click Music - Muzica, Hip-Hop, Reggae, Soul" />
    <meta property="og:description"
        content="Click Music - Muzica, Hip-Hop, Reggae, Soul - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG-Site.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-Hop, Reggae, Soul" />
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Reggae, Soul" />


    <link rel="canonical" href="https://clickmusic.ro" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />


    <title>Click Music - Muzica, Hip-Hop, Reggae, Soul</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

    <!-- Schema Markup for SEO -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MusicArtist",
  "name": "Click",
  "description": "Click este un artist de muzică hip-hop, reggae și soul din Baia-Mare, Maramureș.",
  "genre": ["Hip-Hop", "Reggae", "Soul"],
  "url": "https://clickmusic.ro",
  "image": "{{ asset('img/ClickMusic-OG-Site.jpg') }}",
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
</script>

</head>

<body class="font-sans antialiased bg-black">

    <livewire:header-nav />

<main class="container py-20 mx-auto">
    <!-- Gradient ambient în fundal -->
    <div class="relative min-h-screen">
        <div class="absolute inset-0 blur-3xl opacity-30">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-purple-600 to-blue-800"></div>
        </div>

        <!-- Secțiunea Premium -->
        <div class="relative max-w-xl px-6 py-20 mx-auto">
            <div class="text-center">
                <!-- Header cu gradient -->
                <h1 class="mb-8 text-3xl md:text-4xl font-bold tracking-[0.2em] text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 uppercase font-roboto-condensed">
                    Acces Premium
                </h1>
                
                <!-- Card principal -->
                <div class="p-[0.5px] bg-gradient-to-br from-blue-500/20 via-purple-500/20 to-blue-500/20 rounded-xl">
                    <div class="p-8 bg-black/70 backdrop-blur-sm rounded-xl">
                        <div class="space-y-6">
                            <p class="text-lg text-gray-300">
                            Te invit sa faci parte din Comunitatea mea. 
                            
                            </p>

                             <p class="text-base text-gray-300">
                    
                               Aceasta comunitate este un club exclusiv  care are acces la piese pe care inca nu le-am lansat si la videoclipuri in Premiera.
                            </p>

                              <p class="text-base text-gray-300">
                    
                               "Cotizatia" pentru accesul in acest club este una simbolica de aproape 10 lei pe luna. Banii vor fi folositi pentru imbunatatirea si sustinerea acestei platforme si a proiectele viitoare.
                            </p>
                            
                           
                            <div class="py-4">
                                <span class="text-2xl font-semibold text-blue-300">9,99 lei/ lună</span>
                            </div>

                            @if (Route::has('login'))
                                <div class="py-6 border-t border-white/10">
                                    <livewire:welcome.navigation />
                                </div>
                            @endif

                            <!-- Buton Google -->
                           <div class="mt-8">
    <!-- Container cu efect de gradient border -->
    <div class="relative group">
        <!-- Gradient animat de fundal -->
        <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-lg blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
        
        <!-- Butonul în sine -->
        <a href="{{ route('login.google') }}"
           class="relative flex items-center justify-center px-8 py-4 text-white transition-all duration-300 rounded-lg bg-black/80 backdrop-blur-sm group-hover:bg-black/90">
            <!-- Icon Google -->
            <div class="flex items-center justify-center w-8 h-8 mr-3 transition-transform duration-300 bg-white rounded-full group-hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-5 h-5" 
                     viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
            </div>

            <!-- Text -->
            <span class="text-base font-medium tracking-wide">
                Sign in with Google
            </span>

            <!-- Săgeată animată -->
            <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" 
                 fill="none" 
                 stroke="currentColor" 
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </a>
    </div>
</div>
                        </div>
                    </div>
                </div>

                <!-- Features (opțional) -->
                <div class="grid grid-cols-1 gap-6 mt-12 md:grid-cols-2">
                    <div class="p-6 border bg-white/5 backdrop-blur-sm rounded-xl border-white/10">
                        <svg class="w-8 h-8 mx-auto mb-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <h3 class="mb-2 text-lg font-semibold text-white">Videoclipuri Exclusive</h3>
                        <p class="text-gray-400">Acces la conținut premium și lansări în avanpremieră</p>
                    </div>

                    <div class="p-6 border bg-white/5 backdrop-blur-sm rounded-xl border-white/10">
                        <svg class="w-8 h-8 mx-auto mb-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <h3 class="mb-2 text-lg font-semibold text-white">Download Nelimitat</h3>
                        <p class="text-gray-400">Descarcă muzica preferată pentru ascultare offline</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    <x-footer />

</body>

</html>
