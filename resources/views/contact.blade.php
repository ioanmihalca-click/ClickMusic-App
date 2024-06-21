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


    <link rel="canonical" href="https://clickmusic.ro" />

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
  

    <!-- Additional Styles -->
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
        "@type": "MusicGroup",
        "name": "Click",
        "genre": ["Hip-Hop", "Soul", "Reggae"],
        "url": "https://clickmusic.ro",
        "image": "{{ asset('img/ClickMusic-OG.jpg') }}",
        "description": "Click este un artist de muzică hip-hop, soul și reggae din Baia-Mare, Maramureș."
    }
    </script>

</head>

<body class="font-sans antialiased">
    <div class="text-black bg-gray-50">
        <div class="relative min-h-screen flex flex-col items-center  selection:bg-[#FF2D20] selection:text-white">
            <header class="flex flex-col items-center justify-center mt-2 mb-8">
            <a href="/" >
                <img src="/img/logo.png" alt="Logo Click Music" class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
                </a>
            </header>
 <div class="max-w-md p-2 bg-white rounded">
            <p class="mt-4 text-left text-gray-700">
            
Pentru orice nelămuriri, sugestii sau reclamații, suntem aici să vă ajutăm: <br><br>
📧 Email: contact@clickmusic.ro <br>
⏱️ Timp de răspuns: În maxim 24 de ore în zilele lucrătoare <br>
👥 Echipa noastră dedicată de suport este gata să vă asiste <br>
Vă încurajăm să ne contactați pentru:<br><br>

Întrebări despre abonamente<br>
Asistență tehnică<br>
Sugestii pentru îmbunătățirea platformei<br>
Feedback despre experiența dumneavoastră<br>
Orice alte nelămuriri legate de serviciile noastre<br><br>

Așteptăm cu interes să auzim de la voi!
                <a href="mailto:contact@clickmusic.ro" class="text-blue-500 hover:underline">contact@clickmusic.ro</a>.
            </p>
            </div
        </div>
    </div>

          <footer class="py-16 text-sm text-center text-black">
                    ClickMusic &copy; {{ date('Y') }}.Toate drepturile rezervate.
                    <div class="mt-2">
                        Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank" rel="noopener noreferrer"
                            class="text-blue-500">Click Studios
                            Digital</a>.
                    </div>

                    <div class="flex-row mt-4">
                        <a href="{{ route('privacy-policy') }}" class="text-blue-500">Politica de
                            confidențialitate</a>
                        |
                        <a href="{{ route('terms-of-service') }}" class="text-blue-500">Termeni și Condiții</a>
                        |
                        <a href="{{ route('contact') }}" class="text-blue-500">Contact</a>
                    </div>

                </footer>
</body>

</html>               
        