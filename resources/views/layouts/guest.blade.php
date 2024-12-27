<!DOCTYPE html>
<html lang="ro">
<head>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-34NT57GG5F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-34NT57GG5F');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta Tags -->
    <meta name="description" content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul Click din Baia Mare, Maramureș, Romania" />
    <meta name="keywords" content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video" />

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />
    <meta property="og:description" content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul Click din Baia Mare, Maramureș, Romania" />
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />
    <meta property="og:url" content="https://clickmusic.ro" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />

    <link rel="canonical" href="https://clickmusic.ro" />
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <title>Click Music - Muzica, Hip-Hop, Soul, Reggae</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
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
            background-color: #1f2937;
            border-radius: 3px;
        }
    </style>
</head>
<body class="font-sans antialiased text-white bg-black">
    <div class="relative min-h-screen">
        <!-- Background with gradient -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-black"></div>
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-900/20 via-gray-900/0 to-gray-900/0"></div>
        </div>

        <!-- Content -->
        <div class="relative flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0">
            <div class="z-10">
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 text-blue-400 transition-colors duration-300 fill-current hover:text-blue-500" />
                </a>
            </div>

            <div class="z-10 w-full px-8 py-8 mt-6 overflow-hidden sm:max-w-md">
                <div class="p-6 border shadow-xl bg-gray-800/50 backdrop-blur-sm border-gray-700/30 rounded-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>