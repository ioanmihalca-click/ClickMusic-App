<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $video->title }}</title>
    <meta property="og:title" content="{{ $video->title }}" />
    <meta property="og:description" content="{{ $video->description }}" />
    <meta property="og:image" content="{{ $video->thumbnail_url }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="{{ $video->title }}"/>
    <meta property="og:image:width" content="1920" />
    <meta property="og:image:height" content="1080" />
    <meta property="og:url" content="{{ route('videos.share', $video->id) }}" />
    <meta property="og:type" content="video.other" />

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
