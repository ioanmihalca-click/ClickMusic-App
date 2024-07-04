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
        content="Blog-ul Click Music - Noutăți, articole și povești din lumea hip-hop, soul și reggae" />
    <meta name="keywords"
        content="Click Music, blog, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, articole muzicale, noutăți muzicale" />

    <!-- Open Graph Tags for Social Media Sharing -->
    <meta property="og:title" content="Blog Click Music - Noutăți din Hip-Hop, Soul și Reggae" />
    <meta property="og:description"
        content="Descoperă cele mai recente articole, noutăți și povești din lumea hip-hop, soul și reggae pe blogul lui Click" />
    <meta property="og:image" content="{{ asset('img/ClickMusic-Blog-OG.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Blog Click Music - Noutăți din Hip-Hop, Soul și Reggae" />
    <meta property="og:url" content="https://clickmusic.ro/blog" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music Blog" />

     <meta name="description" content="@yield('meta_description', 'Default blog description')">

    <link rel="canonical" href="https://clickmusic.ro/blog" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <title>Blog Click Music - Noutăți din Hip-Hop, Soul și Reggae</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Schema Markup for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Blog",
        "name": "Click Music Blog",
        "url": "https://clickmusic.ro/blog",
        "image": "{{ asset('img/ClickMusic-Blog-OG.jpg') }}",
        "description": "Blog-ul oficial Click Music cu articole, noutăți și povești din lumea hip-hop, soul și reggae.",
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
<body>
            <header class="flex flex-col items-center justify-center mt-2 mb-8">
            <a href="/" >
                <img src="/img/logo.png" alt="Logo Click Music" class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
                </a>
            </header>

 

    <main class="container px-4 py-8 mx-auto">
        {{ $slot }}
    </main>

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

                     |
                        <a href="{{ route('blog.index') }}" class="text-blue-500">Blog</a>
                    </div>

                </footer>

    @livewireScripts
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>