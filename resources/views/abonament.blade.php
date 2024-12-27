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
        <div class="relative h-full p-8 bg-gradient-to-b from-gray-800/50 to-gray-900/50 backdrop-blur-sm border border-gray-700/30 rounded-2xl text-center transition-all duration-300 hover:scale-[1.02] hover:border-blue-500/50">
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

  <footer class="py-8 text-white bg-gray-800">
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap justify-between">
                <div class="w-full mb-6 md:w-1/3 md:mb-0">
                    <h3 class="mb-2 text-xl font-bold">Click Music</h3>
                    <p class="text-gray-400">Hip-Hop, Reggae și Soul din inima României</p>
                </div>
                <div class="w-full mb-6 md:w-1/3 md:mb-0">
                    <h3 class="mb-2 text-xl font-bold">Link-uri rapide</h3>
                    <ul class="text-gray-400">
                        <li><a href="{{ route('privacy-policy') }}" class="hover:text-white">Politica de
                                confidențialitate</a></li>
                        <li><a href="{{ route('terms-of-service') }}" class="hover:text-white">Termeni și Condiții</a>
                        </li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/3">
                    <h3 class="mb-3 text-xl font-bold">Mă găsesti și aici:</h3>
                    <div class="flex mx-auto space-x-4">
                        <a href="https://instagram.com/clickmusic1" target="_blank" rel="noopener noreferrer"
                            class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                class="" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                            </svg>
                        </a>

                        <a href="https://www.facebook.com/clickmusicromania" target="_blank" rel="noopener noreferrer"
                            class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                class="" viewBox="0 0 16 16">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                            </svg>
                        </a>

                        <a href="https://open.spotify.com/artist/0rbyxJSUfSXjmeW652c41O?si=4I3hPlSITruYO69znEmXFA&nd=1&dlsi=cf9e5847f277482e"
                            target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                class="" viewBox="0 0 16 16">
                                <path
                                    d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288" />
                            </svg>
                        </a>

                        <a href="https://youtube.com/clickmusicromania" target="_blank" rel="noopener noreferrer"
                            class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                fill="currentColor" class="" viewBox="0 0 16 16">
                                <path
                                    d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                            </svg>
                        </a>

                    </div>
                </div>
            </div>
            <div class="mt-8 text-sm text-center text-gray-400">
                <p>&copy; {{ date('Y') }} ClickMusic. Toate drepturile rezervate.</p>
                <p class="mt-2">Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank"
                        rel="noopener noreferrer" class="text-blue-300 hover:text-white">Click Studios Digital</a>.
                </p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>

</html>

