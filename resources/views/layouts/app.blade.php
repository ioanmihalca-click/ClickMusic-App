<!DOCTYPE html>
<html lang="ro" class="h-full">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-34NT57GG5F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-34NT57GG5F');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta Tags for Click Music Streaming App -->
    <meta name="description" content="Click Music - Muzica, Hip-Hop, Reggae, Soul - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click">
    <meta name="keywords" content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video, videoclipuri exclusive">
    
    <!-- Open Graph Tags for Social Media Sharing -->
    <meta property="og:title" content="Click Music - Muzica, Hip-Hop, Soul, Reggae">
    <meta property="og:description" content="Click Music - Muzica, Hip-Hop, Reggae, Soul - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click">
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG.jpg') }}">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-Hop, Reggae, Soul">
    <meta property="og:url" content="https://clickmusic.ro">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ro_RO">
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Reggae, Soul">

    <link rel="canonical" href="https://clickmusic.ro">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    <title>Click Music - Muzica, Hip-Hop, Reggae, Soul</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles

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
            background-color: #1f2937;
            border-radius: 3px;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen font-sans antialiased text-white bg-black">
    <div class="flex-grow">
        <livewire:layout.navigation />

        <!-- Main Content -->
        <main class="min-h-screen">
            {{ $slot }}
        </main>
    </div>

    <x-footer />
   
   @livewireScripts
</body>

</html>
