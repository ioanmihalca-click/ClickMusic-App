<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta Tags for Click Music Streaming App -->
    <meta name="description"
        content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta name="keywords"
        content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video, videoclipuri exclusive" />

    <title>{{ $video->title }}</title>
    <meta property="og:title" content="{{ $video->title }}" />
    {{-- <meta property="og:description" content="{{ $video->description }}" /> --}}
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="{{ $video->title }}" />

    <meta property="og:url" content="{{ route('videos.share', $video->id) }}" />
    <meta property="og:type" content="video.other" />

    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Schema Markup for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "MusicGroup",
        "name": "Click",
        "genre": ["Hip-Hop", "Soul", "Reggae"],
        "url": "https://clickmusic.ro",
        "image": "{{ asset('img/ClickMusic-OG.jpg') }}",
        "description": "Click este un artist de muzică hip-hop, soul și reggae din Baia-Mare, Maramureș."
    }
    </script>


</head>

<body class="px-4 bg-gray-50">
    <div class="flex items-center justify-center mb-8 ">
        <a href="/">
            <img src="/img/logo.png" alt="Logo Click Music"
                class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
        </a>
    </div>

    <div class="max-w-md p-2 mx-auto mt-8 text-left text-center bg-white rounded-lg shadow-lg">
        <div class="mb-4 aspect-w-16 aspect-h-9">
            <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}"
                class="object-cover w-full h-full rounded-md">
        </div>

        <h1 class="mb-2 text-xl font-semibold">{{ $video->title }}</h1>
        {{-- <p class="text-gray-700">{{ $video->description }}</p> --}}
      <p class="mt-4 mb-2 text-center text-gray-500">
    Pentru a avea acces la videoclipuri va rugam sa va 
    <a href="/register" class="px-2 text-white bg-blue-500 rounded-sm">înregistrati</a> 
    sau sa va 
    <a href="/login" class="px-2 text-white bg-blue-500 rounded-sm">logati</a>.
</p>


    </div>

    <footer class="py-16 text-sm text-center text-black">
        ClickMusic &copy; {{ date('Y') }}.Toate drepturile rezervate.
        <div class="mt-2">
            Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank"
                class="text-blue-500">Click Studios
                Digital</a>.
        </div>

        <div class="flex-row mt-4">
            <a href="{{ route('privacy-policy') }}" class="text-blue-500">Politica de
                confidențialitate</a>
            |
            <a href="{{ route('terms-of-service') }}" class="text-blue-500">Termeni și Condiții</a>

        </div>

    </footer>
</body>

</html>
