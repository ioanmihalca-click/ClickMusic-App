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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta Tags for Click Music Streaming App -->
    <meta name="description"
        content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta name="keywords"
        content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video, videoclipuri exclusive" />
    <!-- Open Graph Tags for Social Media Sharing -->
    
    @isset($video)
        <meta property="og:title" content="{{ $video->title }}" />
        <meta property="og:description" content="{{ $video->description }}" />
        <meta property="og:image" content="{{ $video->thumbnail_url }}" />
        <meta property="og:image:alt" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />
        <meta property="og:url" content="{{ route('videos.show', $video->id) }}" />
        <meta property="og:type" content="video.other" />
    @endisset
    
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
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
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


</head>

<body class="font-sans antialiased scrollbar-thin scrollbar-thumb-blue-500 scrollbar-track-gray-300">
    <div class="min-h-screen bg-gray-100">

        <livewire:layout.navigation />

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <footer class="py-16 text-sm text-center text-black">
            ClickMusic &copy; {{ date('Y') }}.Toate drepturile rezervate.
            <div class="mt-2">
                Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank"
                    class="text-blue-500">Click Studios
                    Digital</a>.
            </div>

            <div class="flex-row mt-4">
                <a href="{{ route('privacy-policy') }}" class="text-blue-500">Politica de confidențialitate</a>
                |
                <a href="{{ route('terms-of-service') }}" class="text-blue-500">Termeni și Condiții</a>
            </div>
        </footer>
    </div>
</body>

</html>
