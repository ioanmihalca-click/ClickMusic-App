<!DOCTYPE html>
<html class="scroll-smooth" lang="ro">

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

    <!-- Dynamic Meta Tags -->
    <title>{{ $title ?? 'Click Music - Muzica, Hip-Hop, Drum & Bass si Reggae' }}</title>
    <meta name="description"
        content="{{ $description ?? 'Click Music - Muzica, Hip-Hop, Drum & Bass si Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click' }}" />
    <meta name="keywords"
        content="{{ $keywords ?? 'Click Music, streaming video, hip-hop, Drum & Bass si reggae, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video, videoclipuri exclusive' }}" />

    <!-- Open Graph Tags -->
    <meta property="og:title"
        content="{{ $ogTitle ?? ($title ?? 'Click Music - Muzica, Hip-Hop, Drum & Bass si Reggae') }}" />
    <meta property="og:description"
        content="{{ $ogDescription ?? ($description ?? 'Click Music - Muzica, Hip-Hop, Drum & Bass si Reggae - O aplicație de streaming video a artistului de muzică hip-hop, drum & bass si reggae - Click') }}" />
    <meta property="og:image" content="{{ $ogImage ?? asset('img/OG.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-hop, drum & bass si Reggae" />
    <meta property="og:url" content="{{ $ogUrl ?? url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-hop, drum & bass si Reggae" />

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" as="style">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Custom Styles -->
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

    <!-- Schema Markup -->
    @if (isset($schemaMarkup))
        {!! $schemaMarkup !!}
    @else
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "MusicArtist",
          "name": "Click",
          "description": "Click este un artist de muzică hip-hop, drum & bass si reggae din România.",
          "genre": ["Hip-Hop", "Reggae", "Soul"],
          "url": "https://clickmusic.ro",
          "image": "{{ asset('img/ClickMusic-OG-Site.jpg') }}",
          "sameAs": [
            "https://youtube.com/clickmusicromania"
          ]
        }
        </script>
    @endif

    <!-- Additional Head Content -->
    {{ $head ?? '' }}
</head>

<body class="font-sans antialiased {{ $bodyClass ?? 'bg-black' }}">
    <!-- Header Navigation -->
    <livewire:header-nav />

    <!-- Main Content -->
    <main class="{{ $mainClass ?? '' }}">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Cookie Consent Banner -->
    @include('partials.cookie-consent')

    @livewireScripts

    <!-- Additional Scripts -->
    {{ $scripts ?? '' }}
</body>

</html>
