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
        content="Click Music -Fii la curent cu cele mai recente piese, albume și videoclipuri lansate pe YouTube - Click" />
    <meta name="keywords"
        content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video, videoclipuri exclusive" />

    <!-- Open Graph Tags for Social Media Sharing -->
    <meta property="og:title" content="Click Music - Newsletter" />
    <meta property="og:description"
        content="Click Music -Fii la curent cu cele mai recente piese, albume și videoclipuri lansate pe YouTube - Click" />
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG-Site.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-Hop, Reggae, Soul" />
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Reggae, Soul" />


    <link rel="canonical" href="https://clickmusic.ro/newsletter" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />


    <title>Click Music - Newsletter</title>

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

    <main class="container px-4 py-12 mx-auto ">
        <!-- Newsletter Section -->
        <div  class="h-screen max-w-md px-6 py-20 mx-auto">
        
            @if (session('success'))
                <div class="mt-4 text-green-400">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="mt-4 text-red-400">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="mt-12 mb-6 text-2xl tracking-widest text-blue-400 uppercase font-roboto-condensed md:text-3xl">
                Abonează-te la newsletter
            </h2>
            <p class="mt-4 mb-6 text-lg leading-8 text-gray-300">Trimit un email de fiecare data cand lansez ceva nou
                pe Youtube</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                    <div class="flex-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Numele tău</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="block w-full px-4 py-2 text-sm text-white transition duration-300 ease-in-out bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700"
                            placeholder="Introdu numele tău">
                    </div>
                    <div class="flex-1">
                        <label for="email-address" class="block mb-2 text-sm font-medium text-gray-300">Adresa de
                            email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="block w-full px-4 py-2 text-sm text-white transition duration-300 ease-in-out bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700"
                            placeholder="Adaugă emailul tău">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="w-32 px-3.5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors duration-300">
                        Abonează-te
                    </button>
                </div>
                <p class="mt-3 text-sm">
                    <a href="{{ route('privacy-policy') }}" class="text-blue-400 hover:text-blue-300">
                        Politica de confidențialitate
                    </a>
                </p>
            </form>
        </div>


        </div>
    </main>


    <x-footer />
</body>

</html>
