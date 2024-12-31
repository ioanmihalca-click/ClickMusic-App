<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $post->meta['title'] ?? $post->title }} - Click Music Blog</title>
    <meta name="description" content="{{ $post->meta['description'] ?? '' }}">
    <meta name="keywords" content="{{ $post->meta['keywords'] ?? 'Click Music, blog, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, articole muzicale, noutăți muzicale' }}">
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
        function gtag(){dataLayer.push(arguments);}
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
            background-color: #d1d5db;
            border-radius: 3px;
        }

        /* Typography improvements */
        .prose p {
            margin-top: 1.5em;
            margin-bottom: 1.5em;
            line-height: 1.8;
        }
        
        .prose h2 {
            margin-top: 2em;
            margin-bottom: 1em;
        }
        
        .prose ul, .prose ol {
            margin-top: 1.5em;
            margin-bottom: 1.5em;
        }
        
        .prose li {
            margin-top: 0.5em;
            margin-bottom: 0.5em;
        }

        /* Reading improvements */
        .prose {
            font-size: 1.125rem;
            letter-spacing: 0.01em;
        }

        @media (min-width: 768px) {
            .prose {
                font-size: 1.25rem;
            }
        }

        /* Container width for better readability */
        .content-container {
            max-width: 75ch;
            margin-left: auto;
            margin-right: auto;
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

<body class="font-sans antialiased bg-gray-950">
    <livewire:header-nav />

    <main class="container px-4 py-4 mx-auto">
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
</body>
</html>