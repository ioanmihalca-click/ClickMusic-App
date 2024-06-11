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
    <meta property="og:url" content="https://clickmusic.ro/abonament" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />


    <link rel="canonical" href="https://clickmusic.ro/abonament" />

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
  
 
            <header class="flex flex-col items-center justify-center mt-2 mb-4">
                <img src="/img/logo.png" alt="Logo Click Music"
                    class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">


</header>


<!-- Pricing -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Title -->
    <div class="max-w-2xl mx-auto mb-10 text-center lg:mb-14">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight">Planuri de abonament</h2>
        <p class="mt-1 text-gray-600">Alege planul care ti se potriveste.</p>
    </div>
    <!-- End Title -->

    <!-- Grid -->
    <div class="flex flex-wrap justify-center gap-6 mt-12">
        <!-- Card -->
        <div class="w-full sm:w-80 md:w-64 lg:w-72 p-8 text-center border border-gray-200 shadow-md rounded-xl transition-transform transform hover:shadow-xl hover:scale-105">
            <h4 class="text-lg font-medium text-gray-800">Lunar</h4>
            <div class="mt-5 text-5xl font-bold text-gray-800">
                <span class="text-2xl font-bold align-top">Lei</span>
                9.99
            </div>
            <p class="mt-2 text-sm text-gray-500">Fara nici o obligatie. <br> Anulezi oricand.</p>
            <a href="{{ route('checkout', ['plan' => 'price_1PQ3d2LHnRRaUZdBVHGvJcQX']) }}" class="inline-flex items-center justify-center px-4 py-3 mt-5 text-sm font-semibold text-indigo-800 bg-indigo-100 border border-transparent rounded-lg gap-x-2 hover:bg-indigo-200 disabled:opacity-50 disabled:pointer-events-none">
                Aboneaza-te
            </a>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="w-full sm:w-80 md:w-64 lg:w-72 p-8 text-center border border-gray-200 shadow-md rounded-xl transition-transform transform hover:shadow-xl hover:scale-105">
            {{-- <p class="mb-3">
                <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-indigo-100 text-indigo-800">Cel mai popular</span>
            </p> --}}
            <h4 class="text-lg font-medium text-gray-800">Anual</h4>
            <div class="mt-5 text-5xl font-bold text-gray-800">
                <span class="text-2xl font-bold align-top">Lei</span>
                99.99
            </div>
            <p class="mt-2 text-sm text-gray-500">Platesti pe un an. <br> Ai 2 luni gratis.</p>
            <a href="{{ route('checkout', ['plan' => 'price_1PQDByLHnRRaUZdBbQo07mPl']) }}" class="inline-flex items-center justify-center px-4 py-3 mt-5 text-sm font-semibold text-indigo-800 bg-indigo-100 border border-transparent rounded-lg gap-x-2 hover:bg-indigo-200 disabled:opacity-50 disabled:pointer-events-none">
                Aboneaza-te
            </a>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Grid -->
</div>
<!-- End Pricing -->




   <footer class="py-16 text-sm text-center text-black">
                    ClickMusic &copy; {{ date('Y') }}.Toate drepturile rezervate.
                    <div class="mt-2">
                        Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank"
                            class="text-blue-500">Click Studios
                            Digital</a>.
                    </div>

                    <div class="flex-row mt-4">
                        <a href="{{ route('privacy-policy') }}" class="text-blue-500">Politica de
                            confidențialitate</a>
                        |
                        <a href="{{ route('terms-of-service') }}" class="text-blue-500">Termeni și Condiții</a>

                    </div>

                </footer>

            </div>
        </div>
    </div>


 <footer class="py-16 text-sm text-center text-black">
                    ClickMusic &copy; {{ date('Y') }}.Toate drepturile rezervate.
                    <div class="mt-2">
                        Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank"
                            class="text-blue-500">Click Studios
                            Digital</a>.
                    </div>

                    <div class="flex-row mt-4">
                        <a href="{{ route('privacy-policy') }}" class="text-blue-500">Politica de
                            confidențialitate</a>
                        |
                        <a href="{{ route('terms-of-service') }}" class="text-blue-500">Termeni și Condiții</a>

                    </div>

                </footer>

            </div>
        </div>
    </div>
</body>

</html>
