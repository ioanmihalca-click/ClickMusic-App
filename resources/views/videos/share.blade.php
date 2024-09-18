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

    <div class="max-w-md p-2 mx-auto mt-8 text-center bg-white rounded-lg shadow-lg">
        <div class="mb-4 aspect-w-16 aspect-h-9">
            <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}"
                class="object-cover w-full h-full rounded-md">
        </div>

        <h1 class="mb-2 text-xl font-semibold">{{ $video->title }}</h1>
        {{-- <p class="text-gray-700">{{ $video->description }}</p> --}}
         <p class="mt-4 text-base">
                             
                    Pentru acces complet la întreaga colecție de videoclipuri, inclusiv cele mai recente lansări și PREMIERE exclusive, abonează-te pentru doar <br>
                    <span class="font-semibold text-blue-500"> 9,99 lei/lună. </span> <br>
                    
                               
        <div class="mt-2">
            <a href="/register" class="px-2 text-white ease-in-out bg-blue-500 rounded-md hover:bg-gray-700">Abonează-te</a>

            <a href="/login" class="px-2 text-white ease-in-out bg-blue-500 rounded-md hover:bg-gray-700">Sunt deja membru</a>

        </div>
        {{-- Google Login --}}
        
                   
                        <a href="{{ route('login.google') }}"
                            class="inline-flex items-center justify-center px-4 py-1 mt-4 text-white transition duration-300 ease-in-out bg-gray-600 rounded-md shadow-md hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="inline-block mr-2 bi bi-google" viewBox="0 0 16 16">
                                <path
                                    d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                            </svg>
                            Sign in with Google
                        </a>

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
