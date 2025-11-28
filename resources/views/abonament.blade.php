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

    <!-- Meta Tags for Click Music Streaming App -->
    <meta name="description"
        content="Click Music - Muzica, Hip-Hop, Reggae, Soul - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta name="keywords"
        content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video, videoclipuri exclusive" />

    <!-- Open Graph Tags for Social Media Sharing -->
    <meta property="og:title" content="Click Music - Muzica, Hip-Hop, Reggae, Soul" />
    <meta property="og:description"
        content="Click Music - Muzica, Hip-Hop, Reggae, Soul - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG-Site.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-Hop, Reggae, Soul" />
    <meta property="og:url" content="https://clickmusic.ro/abonament" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Reggae, Soul" />


    <link rel="canonical" href="https://clickmusic.ro/abonament" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />


    <title>Click Music - Muzica, Hip-Hop, Drum & Bass, Reggae</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
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
    </style>
</head>

<body class="font-sans antialiased text-white bg-black">
    <livewire:header-nav />

    <!-- Alert Messages -->
    @if (session()->has('success'))
        <div class="max-w-2xl px-4 py-3 mx-auto mt-4 border rounded-lg bg-blue-500/10 border-blue-500/20">
            <p class="text-blue-400">{{ session()->get('success') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="max-w-2xl px-4 py-3 mx-auto mt-4 border rounded-lg bg-red-500/10 border-red-500/20">
            <ul class="text-red-400">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <!-- Pricing Section -->
    <div class="max-w-[85rem] px-4 py-20 pt-8 mx-auto sm:px-6 lg:px-8">
        <!-- Title -->
        <div class="max-w-3xl mx-auto my-24 text-center">
            <div
                class="inline-flex items-center px-4 py-2 mb-6 text-sm font-medium text-blue-400 border rounded-full bg-blue-500/10 border-blue-500/20">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Premium Experience
            </div>
            <h2
                class="mb-6 text-5xl font-bold tracking-tight text-transparent md:text-6xl bg-clip-text bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500">
                Access Premium
            </h2>
            <p class="max-w-2xl mx-auto mt-6 text-xl leading-relaxed text-gray-300">
                Fii parte din Comunitate și bucură-te de conținutul exclusiv.
            </p>
        </div>

        <!-- Pricing Cards -->
        <div class="flex flex-col items-center justify-center gap-10 lg:flex-row lg:items-stretch">
            @if ($user->isPremium())
                <!-- User already has Premium access -->
                <a href="{{ route('videoclipuri') }}" class="group w-full max-w-sm">
                    <div
                        class="relative h-full p-10 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-lg border border-white/10 rounded-3xl text-center transition-all duration-500 ring-1 ring-blue-400/5">

                        <div class="relative z-10">
                            <div class="flex flex-col items-center justify-center gap-8">
                                <!-- Premium Icon with enhanced styling -->
                                <div
                                    class="relative inline-flex p-6 text-blue-300 border shadow-xl rounded-2xl bg-gradient-to-br from-blue-500/20 to-purple-500/20 border-blue-400/30">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-purple-400/10 rounded-2xl animate-pulse">
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                        fill="currentColor" class="relative z-10" viewBox="0 0 16 16">
                                        <path
                                            d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z" />
                                        <path
                                            d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                    </svg>
                                </div>

                                <!-- Status text -->
                                <div class="space-y-4">
                                    <p class="text-lg leading-relaxed text-gray-300">
                                        Ai acces
                                    </p>
                                    <p class="text-3xl font-bold tracking-wide text-blue-400">
                                        PREMIUM
                                    </p>
                                </div>

                                <!-- Enhanced button -->
                                <button
                                    class="w-full px-8 py-4 mt-6 text-base font-semibold text-white transition-all duration-300 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:from-blue-700 hover:to-blue-800 hover:shadow-lg hover:shadow-blue-500/25 transform hover:-translate-y-0.5">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Vizionează conținut
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <!-- Free Plan -->
                <div class="w-full max-w-sm">
                    <div
                        class="relative h-full p-10 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-gray-950/60 backdrop-blur-lg border border-white/10 rounded-3xl text-center transition-all duration-500 ring-1 ring-white/5">

                        <div class="absolute transform -translate-x-1/2 -top-5 left-1/2">
                            <span
                                class="px-6 py-3 text-sm font-semibold text-gray-300 border rounded-full shadow-lg bg-gray-500/20 border-gray-400/30 backdrop-blur-sm">
                                <svg class="inline w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M4.649 3.084A1 1 0 015.163 4.4 13.95 13.95 0 004 10c0 1.993.416 3.886 1.164 5.6a1 1 0 01-1.832.8A15.95 15.95 0 012 10c0-2.274.475-4.44 1.332-6.4a1 1 0 011.317-.516zM12.96 7a3 3 0 00-2.342 1.126l-.328.41-.111-.279A2 2 0 008.323 7H8a1 1 0 000 2h.323l.532 1.33-1.035 1.295a1 1 0 01-.781.375H7a1 1 0 100 2h.039a3 3 0 002.342-1.126l.328-.41.111.279A2 2 0 0011.677 14H12a1 1 0 100-2h-.323l-.532-1.33 1.035-1.295A1 1 0 0112.961 9H13a1 1 0 100-2h-.039zm1.874-2.6a1 1 0 011.833-.8A15.95 15.95 0 0118 10c0 2.274-.475 4.44-1.332 6.4a1 1 0 11-1.832-.8A13.949 13.949 0 0016 10c0-1.993-.416-3.886-1.165-5.6z" />
                                </svg>
                                Gratuit
                            </span>
                        </div>

                        <div class="relative z-10 mt-12">
                            <h3 class="mb-6 text-3xl font-bold tracking-wide text-white">Plan Free</h3>

                            <div class="flex items-center justify-center mb-8">
                                <span
                                    class="text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-gray-400 to-gray-500">0</span>
                                <div class="ml-3 text-left">
                                    <span class="block text-lg text-gray-400">Lei</span>
                                    <span class="block text-sm text-gray-500">permanent</span>
                                </div>
                            </div>

                            <ul class="mb-10 space-y-5 text-gray-300">
                                <li class="flex items-center justify-center gap-3">
                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-gray-500/20">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-base">Acces la forum</span>
                                </li>
                                <li class="flex items-center justify-center gap-3">
                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-gray-500/20">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-base">Vizualizare listă video</span>
                                </li>
                                <li class="flex items-center justify-center gap-3">
                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-red-500/20">
                                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                    <span class="text-base text-gray-500">Fără acces la conținut</span>
                                </li>
                            </ul>

                            <a href="{{ route('videoclipuri') }}"
                                class="block w-full px-8 py-4 text-base font-semibold text-white transition-all duration-300 bg-gradient-to-r from-gray-600 to-gray-700 rounded-xl hover:from-gray-700 hover:to-gray-800 hover:shadow-lg hover:shadow-gray-500/25 transform hover:-translate-y-0.5">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    Folosește gratuit
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Monthly Plan -->
                <div class="w-full max-w-sm">
                    <div
                        class="relative h-full p-10 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-lg border border-white/10 rounded-3xl text-center transition-all duration-500 ring-1 ring-blue-400/5">

                        <div class="absolute transform -translate-x-1/2 -top-5 left-1/2">
                            <span
                                class="px-6 py-3 text-sm font-semibold text-blue-300 border rounded-full shadow-lg bg-blue-500/20 border-blue-400/30 backdrop-blur-sm">
                                <svg class="inline w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                                </svg>
                                Popular
                            </span>
                        </div>

                        <div class="relative z-10 mt-12">
                            <h3 class="mb-6 text-3xl font-bold tracking-wide text-white">Abonament Lunar</h3>

                            <div class="flex items-center justify-center mb-8">
                                <span
                                    class="text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">9.99</span>
                                <div class="ml-3 text-left">
                                    <span class="block text-lg text-gray-400">Lei</span>
                                    <span class="block text-sm text-gray-500">pe lună</span>
                                </div>
                            </div>

                            <ul class="mb-10 space-y-5 text-gray-300">
                                <li class="flex items-center justify-center gap-3">
                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-blue-500/20">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-base">Acces la toate videoclipurile</span>
                                </li>
                                <li class="flex items-center justify-center gap-3">
                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-blue-500/20">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-base">Conținut exclusiv</span>
                                </li>
                                <li class="flex items-center justify-center gap-3">
                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-blue-500/20">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-base">Anulezi oricând</span>
                                </li>
                            </ul>

                            <a href="{{ route('checkout', ['plan' => 'price_1PabyDLHnRRaUZdBk3McKwYs']) }}"
                                class="block w-full px-8 py-4 text-base font-semibold text-white transition-all duration-300 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:from-blue-700 hover:to-blue-800 hover:shadow-lg hover:shadow-blue-500/25 transform hover:-translate-y-0.5">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    Alege acest plan
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Yearly Plan -->
                <div class="w-full max-w-sm">
                    <div
                        class="relative h-full p-10 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-green-950/30 backdrop-blur-lg border border-white/10 rounded-3xl text-center transition-all duration-500 ring-1 ring-green-400/5">

                        <div class="absolute transform -translate-x-1/2 -top-5 left-1/2">
                            <span
                                class="px-6 py-3 text-sm font-semibold text-green-300 border rounded-full shadow-lg bg-green-500/20 border-green-400/30 backdrop-blur-sm">
                                <svg class="inline w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                </svg>
                                Cel mai bun preț
                            </span>
                        </div>

                        <div class="relative z-10 mt-12">
                            <h3 class="mb-6 text-3xl font-bold tracking-wide text-white">Abonament Anual</h3>

                            <div class="flex items-center justify-center mb-8">
                                <span
                                    class="text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">99.99</span>
                                <div class="ml-3 text-left">
                                    <span class="block text-lg text-gray-400">Lei</span>
                                    <span class="block text-sm text-gray-500">pe an</span>
                                </div>
                            </div>

                            <div class="p-3 mb-6 bg-green-900/20 border border-green-500/30 rounded-xl">
                                <p class="text-sm font-medium text-green-400">Economisești 16% față de planul lunar</p>
                            </div>

                            <ul class="mb-10 space-y-5 text-gray-300">
                                <li class="flex items-center justify-center gap-3">
                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-base">Tot ce include planul lunar</span>
                                </li>
                                <li class="flex items-center justify-center gap-3">
                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-base">2 luni gratuite</span>
                                </li>
                                <li class="flex items-center justify-center gap-3">
                                    <div
                                        class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-base">Badge premium exclusiv</span>
                                </li>

                            </ul>

                            <a href="{{ route('checkout', ['plan' => 'price_1PabyDLHnRRaUZdBXUK6VBns']) }}"
                                class="block w-full px-8 py-4 text-base font-semibold text-white transition-all duration-300 bg-gradient-to-r from-green-600 to-blue-600 rounded-xl hover:from-green-700 hover:to-blue-700 hover:shadow-lg hover:shadow-green-500/25 transform hover:-translate-y-0.5">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    Alege acest plan
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Active Subscription -->
        @if ($activeSubscription)
            <div
                class="relative max-w-2xl p-8 mx-auto mt-20 text-center border shadow-2xl bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-lg border-white/10 rounded-3xl ring-1 ring-blue-400/5">

                <div class="relative z-10">
                    <div
                        class="inline-flex p-4 mb-6 text-green-400 border shadow-xl rounded-2xl bg-gradient-to-br from-green-500/20 to-blue-500/20 border-green-400/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-white">Abonament Activ</h3>
                    <p class="mb-8 text-lg leading-relaxed text-gray-300">{{ $activeSubscription->stripe_plan }}</p>

                    <div class="p-4 mb-6 border bg-green-500/10 border-green-400/20 rounded-xl">
                        <p class="font-medium text-green-400">
                            <svg class="inline w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Abonamentul tău este activ și funcțional
                        </p>
                    </div>

                    <form action="{{ route('subscription.cancel') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-6 py-3 text-sm font-medium text-red-400 transition-all duration-300 border rounded-xl bg-red-500/10 hover:bg-red-500/20 border-red-400/20 hover:border-red-400/40 hover:shadow-lg hover:shadow-red-500/20">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Anulează Abonamentul
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @endif

        @if (!$activeSubscription && !$user->isPremium())
            <!-- Plan Comparison Table -->
            <div class="mt-20 mb-16">
                <div class="max-w-4xl mx-auto">
                    <h3 class="mb-8 text-2xl font-bold text-center text-white">Comparație Planuri</h3>

                    <div class="overflow-hidden border rounded-xl border-gray-700/50 backdrop-blur-sm bg-gray-900/50">
                        <table class="min-w-full divide-y divide-gray-700/50">
                            <thead class="bg-gray-800/70">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-sm font-medium text-left text-gray-300">
                                        Caracteristici
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-4 text-sm font-medium text-center text-gray-300">
                                        Free
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-4 text-sm font-medium text-center text-blue-400">
                                        Premium
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700/50">
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                        Acces la forum
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <svg class="w-5 h-5 mx-auto text-green-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <svg class="w-5 h-5 mx-auto text-green-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                        Badge în comunitate
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded bg-gray-800/60 text-gray-400">Free</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded bg-blue-900/60 text-blue-400">Premium</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                        Vizualizare lista video
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <svg class="w-5 h-5 mx-auto text-green-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <svg class="w-5 h-5 mx-auto text-green-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                        Vizionare videoclipuri
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <svg class="w-5 h-5 mx-auto text-red-500" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <svg class="w-5 h-5 mx-auto text-green-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-300 whitespace-nowrap">
                                        Acces la conținut exclusiv
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <svg class="w-5 h-5 mx-auto text-red-500" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <svg class="w-5 h-5 mx-auto text-green-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                    </td>
                                </tr>
                                <tr class="bg-gray-800/30">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-300 whitespace-nowrap">
                                        Preț
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-300 whitespace-nowrap">
                                        <span class="font-medium">0 Lei</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center text-blue-400 whitespace-nowrap">
                                        <span class="font-medium">de la 9.99 Lei / lună</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- User Account Section with Livewire Logout -->
    <div class="max-w-[85rem] px-4 py-12 mx-auto sm:px-6 lg:px-8">
        <div
            class="flex flex-col max-w-3xl p-6 mx-auto space-y-6 border shadow-xl sm:flex-row sm:items-center sm:justify-between sm:p-8 bg-gradient-to-br from-gray-900/80 via-slate-900/70 to-blue-950/40 backdrop-blur-lg border-white/10 rounded-3xl ring-1 ring-blue-400/5 sm:space-y-0">
            <!-- User Info -->
            <div class="flex items-center space-x-4 sm:space-x-6">
                <div class="relative">
                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                        class="rounded-full shadow-lg w-14 h-14 sm:w-16 sm:h-16 border-3 border-blue-400/50">
                    <div
                        class="absolute w-4 h-4 bg-green-500 border-2 border-gray-900 rounded-full sm:w-5 sm:h-5 -bottom-1 -right-1">
                    </div>
                </div>
                <div>
                    <h3 class="mb-1 text-lg font-bold text-white sm:text-xl">{{ auth()->user()->name }}</h3>
                    <p class="mb-2 text-sm text-gray-300">{{ auth()->user()->email }}</p>

                </div>
            </div>

            <!-- Logout Button cu form clasic -->
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                    class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-gray-300 transition-all duration-300 border sm:w-auto sm:px-6 border-gray-600/60 rounded-xl hover:bg-gray-800/80 hover:text-white hover:border-gray-500/60 hover:shadow-lg backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="hidden sm:inline">Ieșire din cont</span>
                    <span class="sm:hidden">Ieșire</span>
                </button>
            </form>
        </div>
    </div>

    <x-footer />

</body>

</html>
