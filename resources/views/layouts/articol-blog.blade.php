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
    <meta property="og:image:width" content="1200">  <meta property="og:image:height" content="630"> <meta property="og:url" content="{{ route('blog.show', $post->slug) }}">
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

<body>
    <header class="flex flex-col items-center justify-center mt-2 mb-4">
        <a href="/">
            <img src="/img/logo.png" alt="Logo Click Music" class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
        </a>
    </header>


    <main class="container px-4 py-8 mx-auto">
        {{ $slot }}
    </main>

    <footer class="py-16 text-sm text-center text-black">
        ClickMusic &copy; {{ date('Y') }}. Toate drepturile rezervate.
        <div class="mt-2">
            Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank" rel="noopener noreferrer" class="text-blue-500">Click Studios Digital</a>.
        </div>
        <div class="flex-row mt-4"> 
            @foreach (['privacy-policy', 'terms-of-service', 'contact', 'blog.index'] as $routeName)
                <a href="{{ route($routeName) }}" class="text-blue-500">{{ ucwords(str_replace(['-', '.'], ' ', $routeName)) }}</a>
                @if (! $loop->last) | @endif 
            @endforeach
        </div>
    </footer>

    @livewireScripts
    <script src="{{ asset('js/app.js') }}" defer></script> 
</body>
</html>