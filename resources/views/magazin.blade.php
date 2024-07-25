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
        content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta name="keywords"
        content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video, videoclipuri exclusive" />

    <!-- Open Graph Tags for Social Media Sharing -->
    <meta property="og:title" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />
    <meta property="og:description"
        content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />
    <meta property="og:url" content="https://clickmusic.ro" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />


    <link rel="canonical" href="https://clickmusic.ro/magazin" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />


    <title>Click Music - Muzica, Hip-Hop, Soul, Reggae</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Schema Markup for SEO -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MusicArtist",
  "name": "Click",
  "description": "Click este un artist de muzică hip-hop, soul și reggae din Baia-Mare, Maramureș.",
  "genre": ["Hip-Hop", "Soul", "Reggae"],
  "url": "https://clickmusic.ro",
  "image": "{{ asset('img/ClickMusic-OG.jpg') }}",
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

@livewireStyles
</head>

<body class="font-sans antialiased">

            <header class="flex flex-col items-center justify-center my-2">
                <img src="/img/logo.png" alt="Logo Click Music"
                    class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
            </header>

            <div class="flex flex-col items-center justify-center min-h-screen bg-white">
    <h1 class="mb-8 text-5xl font-bold text-gray-800 animate-pulse">
        Coming Soon
    </h1>
    <p class="mb-8 text-lg text-gray-800">
       Lucram la magazin. Revenim curand!
    </p>
</div>
  
  {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Albume') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <livewire:album-list />
                </div>
            </div>
        </div>
    </div> --}}

 <footer class="py-16 text-sm text-center text-black">
                ClickMusic &copy; {{ date('Y') }}.Toate drepturile rezervate.
                <div class="mt-2">
                    Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank"
                        rel="noopener noreferrer" class="text-blue-500">Click Studios
                        Digital</a>.
                </div>

                <div class="flex-row mt-4">
                    <a href="{{ route('privacy-policy') }}" class="text-blue-500">Politica de
                        confidențialitate</a>
                    |
                    <a href="{{ route('terms-of-service') }}" class="text-blue-500">Termeni și Condiții</a>
                    |
                    <a href="{{ route('contact') }}" class="text-blue-500">Contact</a>
                    |
                    <a href="{{ route('blog.index') }}" class="text-blue-500">Blog</a>
                </div>

            </footer>

@livewireScripts
            </body>
            </html>