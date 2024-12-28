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
    <meta property="og:url" content="https://clickmusic.ro" />
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
        "genre": ["Hip-Hop", "Reggae", "Soul"],
        "url": "https://clickmusic.ro",
        "image": "{{ asset('img/ClickMusic-OG-Site.jpg') }}",
        "description": "Click este un artist de muzică hip-hop, reggae și soul din Baia-Mare, Maramureș."
    }
    </script>

</head>

<body class="font-sans antialiased bg-black">
    <livewire:header-nav />



<div class="relative min-h-screen py-16">
    <!-- Gradient ambient în fundal -->
    <div class="absolute inset-0 blur-3xl opacity-30">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-600 via-purple-600 to-black"></div>
    </div>

    <!-- Container principal -->
    <div class="container relative px-4 mx-auto">
        <!-- Card principal -->
        <div class="relative p-[0.5px] bg-gradient-to-br from-blue-500/20 via-purple-500/20 to-blue-500/20 rounded-xl max-w-4xl mx-auto mt-24">
            <div class="p-8 text-white bg-black/90 backdrop-blur-sm rounded-xl">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold tracking-[0.2em] text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 uppercase font-roboto-condensed">
                        Contact
                    </h1>
                    <div class="w-24 h-1 mt-2 rounded-full bg-gradient-to-r from-blue-500 to-transparent"></div>
                </div>

                <!-- Conținut -->
                <div class="space-y-6 text-gray-300">
                    <p class="text-lg leading-relaxed">
                        Pentru orice nelămuriri, sugestii sau reclamații, suntem aici să vă ajutăm:
                    </p>

                    <!-- Informații contact -->
                    <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2">
                        <div class="p-6 border rounded-lg bg-white/5 backdrop-blur-sm border-white/10">
                            <div class="flex items-center mb-4 text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-lg font-semibold">Email</span>
                            </div>
                            <a href="mailto:contact@clickmusic.ro" class="text-blue-400 transition-colors duration-300 hover:text-blue-300">
                                contact@clickmusic.ro
                            </a>
                        </div>

                        <div class="p-6 border rounded-lg bg-white/5 backdrop-blur-sm border-white/10">
                            <div class="flex items-center mb-4 text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-lg font-semibold">Timp de răspuns</span>
                            </div>
                            <p>În maxim 24 de ore în zilele lucrătoare</p>
                        </div>
                    </div>

                    <!-- Secțiune servicii -->
                    <div class="p-6 mt-12 border rounded-lg bg-white/5 backdrop-blur-sm border-white/10">
                        <h2 class="mb-4 text-xl font-semibold text-blue-400">Vă încurajăm să ne contactați pentru:</h2>
                        <ul class="space-y-3 list-none">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Întrebări despre abonamente
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Asistență tehnică
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Sugestii pentru îmbunătățirea platformei
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Feedback despre experiența dumneavoastră
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-lg">
                            Așteptăm cu interes să auzim de la voi!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <x-footer />

    @livewireScripts
</body>

</html>
