<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $video->title }}</title>
    <meta property="og:title" content="{{ $video->title }}" />
    <meta property="og:description" content="{{ $video->description }}" />
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />

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
</head>

<body>
    <div
        class="max-w-md mx-auto mt-8 text-left rounded-lg bg-white p-4 shadow-lg ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-blue-500/20 focus:outline-none focus-visible:ring-[#FF2D20]">
        <div class="mb-4 aspect-w-16 aspect-h-9">
            <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}"
                class="object-cover w-full h-full rounded-md">
        </div>

        <h1 class="mb-2 text-xl font-semibold">{{ $video->title }}</h1>
        <p class="text-gray-700">{{ $video->description }}</p>
        <p class="mt-4 text-center text-gray-500">Pentru a urmari videoul complet va rugam sa va <a href='/register'
                class="px-2 text-white bg-blue-500 rounded-sm">inregistrati</a> sau sa va <a href='/login'
                class="px-2 text-white bg-blue-500 rounded-sm">logati</a>.</p>
    </div>
</body>

</html>
