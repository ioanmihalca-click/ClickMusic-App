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

    <!-- Meta Tags for Click Music Blog -->
    <meta name="description"
        content="Blog-ul Click Music - Noutăți, articole și povești din lumea hip-hop, reggae și soul" />
    <meta name="keywords"
        content="Click Music, blog, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, articole muzicale, noutăți muzicale" />

    <!-- Open Graph Tags for Social Media Sharing -->
    <meta property="og:title" content="Blog Click Music - Noutăți din Hip-Hop, Reggae si Soul" />
    <meta property="og:description"
        content="Descoperă cele mai recente articole, noutăți și povești din lumea Hip-Hop, Reggae si Soul pe blogul lui Click" />
    <meta property="og:image" content="{{ asset('img/OG.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Blog Click Music - Noutăți din Hip-Hop, Reggae si Soul" />
    <meta property="og:url" content="https://clickmusic.ro/blog" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music Blog" />


    <link rel="canonical" href="https://clickmusic.ro/blog" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <title>Blog Click Music - Articole și Noutăți din muzică - hip-hop, drum & bass, reggae</title>

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
            background-color: #1f2937;
            border-radius: 3px;
        }

        /* Smooth transitions and modern typography */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .blog-grid-item {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .blog-grid-item:hover {
            transform: translateY(-8px) scale(1.02);
        }

        /* Glass morphism effect */
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(31, 41, 55, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>

    <!-- Schema Markup for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Blog",
        "name": "Click Music Blog",
        "url": "https://clickmusic.ro/blog",
        "image": "{{ asset('img/ClickMusic-OG-Blog.jpg') }}",
        "description": "Blog-ul oficial Click Music cu articole, noutăți și povești din lumea hip-hop, reggae și soul.",
        "publisher": {
            "@type": "Organization",
            "name": "Click Music",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('img/logo.png') }}"
            }
        }
    }
    </script>
</head>

<body class="font-sans antialiased text-white bg-black">

    <livewire:header-nav />

    <main class="container px-6 py-12 mx-auto max-w-7xl">
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>
