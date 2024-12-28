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


    <title>Click Music - Muzica, Hip-Hop, Reggae, Soul</title>

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
<div class="max-w-[85rem] px-4 py-16 mx-auto sm:px-6 lg:px-8">
    <!-- Title -->
    <div class="max-w-2xl mx-auto my-20 text-center">
        <h2 class="text-4xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">
            Premium Access
        </h2>
        <p class="mt-4 text-lg text-gray-400">
            Alege planul care ți se potrivește cel mai bine
        </p>
    </div>

    <!-- Pricing Cards -->
    <div class="flex flex-col items-center justify-center gap-8 lg:flex-row">
        @if ($user->isEligibleForFreePlan())
            <a href="{{ route('videoclipuri') }}">
        <div class="relative h-full p-8 bg-gradient-to-b from-gray-800/50 to-purple-900/50 backdrop-blur-sm border border-gray-700/30 rounded-2xl text-center transition-all duration-300 hover:scale-[1.02] hover:border-blue-500/50">
            <!-- Badge -->
            <div class="absolute transform -translate-x-1/2 -top-4 left-1/2">
                <span class="px-4 py-2 text-sm font-medium text-blue-400 border rounded-full bg-blue-500/10 border-blue-500/20">
                    Super_User
                </span>
            </div>

            <div class="mt-8">
                <div class="flex flex-col items-center justify-center gap-6">
                    <!-- Icon -->
                    <div class="inline-flex p-4 text-blue-400 rounded-full bg-blue-500/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-hearts" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z"/>
                        </svg>
                    </div>

                    <!-- Text -->
                    <div class="space-y-2">
                        <p class="text-gray-300">
                            Vi s-a atribuit rolul de
                        </p>
                        <p class="text-xl font-bold text-white">
                           SUPER USER
                        </p>
                    </div>

                    <!-- Button -->
                    <button class="w-full px-6 py-3 mt-4 text-sm font-medium text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                        Intră în cont
                    </button>
                </div>
            </div>
        </div>
    </a>
        @else
            <!-- Monthly Plan -->
            <div class="w-full max-w-sm">
                <div class="relative h-full p-8 bg-gradient-to-b from-gray-800/50 to-gray-900/50 backdrop-blur-sm border border-gray-700/30 rounded-2xl text-center transition-all duration-300 hover:scale-[1.02] hover:border-blue-500/50">
                    <div class="absolute transform -translate-x-1/2 -top-4 left-1/2">
                        <span class="px-4 py-2 text-sm font-medium text-blue-400 border rounded-full bg-blue-500/10 border-blue-500/20">
                            Popular
                        </span>
                    </div>

                    <div class="mt-8">
                        <h3 class="mb-4 text-2xl font-bold text-white">Abonament Lunar</h3>
                        
                        <div class="flex items-center justify-center mb-6">
                            <span class="text-5xl font-bold text-blue-400">9.99</span>
                            <span class="ml-2 text-gray-400">Lei/lună</span>
                        </div>

                        <ul class="mb-8 space-y-4 text-gray-300">
                            <li class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Acces complet
                            </li>
                            <li class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Anulezi oricând
                            </li>
                        </ul>

                        <a href="{{ route('checkout', ['plan' => 'price_1PabyDLHnRRaUZdBk3McKwYs']) }}" 
                           class="block w-full px-6 py-3 text-sm font-medium text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                            Alege acest plan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Yearly Plan -->
            <div class="w-full max-w-sm">
                <div class="relative h-full p-8 bg-gradient-to-b from-gray-800/50 to-gray-900/50 backdrop-blur-sm border border-gray-700/30 rounded-2xl text-center transition-all duration-300 hover:scale-[1.02] hover:border-blue-500/50">
                    <div class="absolute transform -translate-x-1/2 -top-4 left-1/2">
                        <span class="px-4 py-2 text-sm font-medium text-green-400 border rounded-full bg-green-500/10 border-green-500/20">
                            Economisești 20%
                        </span>
                    </div>

                    <div class="mt-8">
                        <h3 class="mb-4 text-2xl font-bold text-white">Abonament Anual</h3>
                        
                        <div class="flex items-center justify-center mb-6">
                            <span class="text-5xl font-bold text-blue-400">99.99</span>
                            <span class="ml-2 text-gray-400">Lei/an</span>
                        </div>

                        <ul class="mb-8 space-y-4 text-gray-300">
                            <li class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                2 luni gratuite
                            </li>
                            <li class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Acces nelimitat
                            </li>
                        </ul>

                        <a href="{{ route('checkout', ['plan' => 'price_1PabyDLHnRRaUZdBXUK6VBns']) }}" 
                           class="block w-full px-6 py-3 text-sm font-medium text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                            Alege acest plan
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Active Subscription -->
    @if($activeSubscription)
        <div class="max-w-xl p-6 mx-auto mt-16 text-center border bg-gradient-to-b from-gray-800/50 to-gray-900/50 backdrop-blur-sm border-gray-700/30 rounded-2xl">
            <div class="inline-flex p-3 mb-4 text-green-400 rounded-full bg-green-500/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-bold text-white">Abonament Activ</h3>
            <p class="mb-6 text-gray-400">{{ $activeSubscription->stripe_plan }}</p>

            <form action="{{ route('subscription.cancel') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 text-sm font-medium text-red-400 transition-all duration-300 rounded-lg bg-red-500/10 hover:bg-red-500/20">
                    Anulează Abonamentul
                </button>
            </form>
        </div>
    @endif
</div>

  <x-footer />

    @livewireScripts
</body>

</html>

