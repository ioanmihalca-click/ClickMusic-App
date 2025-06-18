<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $post->meta['title'] ?? $post->title }} - Click Music Blog</title>
    <meta name="description" content="{{ $post->meta['description'] ?? '' }}">
    <meta name="keywords"
        content="{{ $post->meta['keywords'] ?? 'Click Music, blog, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, articole muzicale, noutăți muzicale' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->meta['description'] ?? '' }}">
    <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="{{ route('blog.show', $post->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="ro_RO">
    <meta property="og:site_name" content="Click Music Blog">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->meta['description'] ?? '' }}">
    <meta name="twitter:image" content="{{ asset('storage/' . $post->featured_image) }}">

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-34NT57GG5F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-34NT57GG5F');
    </script>

    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
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

        /* Typography improvements for better readability */
        .prose {
            font-size: 1.125rem;
            line-height: 1.8;
            letter-spacing: 0.01em;
        }

        .prose p {
            margin-top: 1.5em;
            margin-bottom: 1.5em;
        }

        .prose h2 {
            margin-top: 2.5em;
            margin-bottom: 1em;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .prose h3 {
            margin-top: 2em;
            margin-bottom: 0.75em;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .prose ul,
        .prose ol {
            margin-top: 1.5em;
            margin-bottom: 1.5em;
        }

        .prose li {
            margin-top: 0.5em;
            margin-bottom: 0.5em;
        }

        .prose blockquote {
            border-left: 4px solid #3B82F6;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 0 8px 8px 0;
            padding: 1rem 1.5rem;
        }

        @media (min-width: 768px) {
            .prose {
                font-size: 1.25rem;
            }
        }

        /* Article container for optimal reading width */
        .article-container {
            max-width: 75ch;
            margin-left: auto;
            margin-right: auto;
        }

        /* Modern glass effect */
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(31, 41, 55, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Smooth transitions */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "{{ $post->title }}",
        "image": "{{ asset('storage/' . $post->featured_image) }}",
        "datePublished": "{{ $post->published_at->format('Y-m-d') }}",
        "dateModified": "{{ $post->updated_at->format('Y-m-d') }}",
        "author": {
            "@type": "Person",
            "name": "Click"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Click Music",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('img/logo.png') }}"
            }
        },
        "description": "{{ $post->meta['description'] ?? '' }}"
    }
    </script>
</head>

<body class="font-sans antialiased text-white bg-black">
    <livewire:header-nav />

    <main class="container px-4 sm:px-6 py-6 sm:py-8 mx-auto max-w-6xl">
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>
