<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Click Music - Magazin | {{ $album->titlu }}</title>

    <!-- Meta Tags -->
    <meta name="description"
        content="Descoperă albumele artistului Click - muzică hip-hop, soul și reggae autentică din inima României. Streaming și achiziție de albume digitale.">
    <meta name="keywords" content="Click Music, hip-hop românesc, soul, reggae, albume muzicale, artist român, Baia Mare">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Click Music - Albume Hip-Hop, Soul și Reggae">
    <meta property="og:description"
        content="Explorează colecția de albume a artistului Click - hip-hop, soul și reggae direct din inima României.">
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Schema Markup -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "MusicArtist",
      "name": "Click",
      "description": "Artist de muzică hip-hop, soul și reggae din Baia Mare, România",
      "image": "{{ asset('img/ClickMusic-OG.jpg') }}",
      "url": "https://clickmusic.ro",
      "genre": ["Hip-Hop", "Soul", "Reggae"],
      "sameAs": [
        "https://youtube.com/clickmusicromania"
      ]
    }
    </script>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-34NT57GG5F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-34NT57GG5F');
    </script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <header class="bg-white shadow">
        <div class="container flex items-center justify-between px-4 py-6 mx-auto">
            <a href="/" class="flex items-center">
                <img src="/img/logo.png" alt="Logo Click Music" class="w-auto h-12">
            </a>
            <nav>
                <a href="/" class="px-3 py-2 text-gray-600 hover:text-gray-900">Acasă</a>
                <a href="/magazin" class="px-3 py-2 text-gray-600 hover:text-gray-900">Albume</a>
                <a href="/blog" class="px-3 py-2 text-gray-600 hover:text-gray-900">Blog</a>
            </nav>
        </div>
    </header>

    <main class="container px-4 py-8 mx-auto">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3">
                            <img src="{{ asset('storage/' . $album->coperta_album) }}" alt="{{ $album->titlu }}"
                                class="w-full rounded-lg shadow-md">
                        </div>
                        <div class="mt-4 md:w-2/3 md:pl-8 md:mt-0">
                            <h1 class="mb-4 text-3xl font-bold">{{ $album->titlu }}</h1>
                            <p class="mb-4 text-gray-600">{!! $album->descriere !!}</p>
                            <p class="mb-4 text-xl font-semibold">Preț: {{ number_format($album->pret, 2) }} RON</p>
                            <p class="mb-4">Genul Muzical: {{ $album->gen_muzical }}</p>
                            <p class="mb-4">Număr de trackuri: {{ $album->numar_trackuri }}</p>
                            <p class="mb-4">An lansare:
                                {{ \Carbon\Carbon::parse($album->data_lansare)->format('Y') }}</p>

                            <form action="{{ route('album.checkout', $album) }}" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="Email" required>
                                <button type="submit"
                                    class="inline-block px-4 py-2 mt-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    Cumpără Acum
                                </button>
                            </form>

                            <!-- Share buttons -->
                            <div class="mt-4">
                                <div class="my-4 text-gray-600">
                                    Distribuie acest album:
                                </div>
                                <div class="flex mt-4 space-x-4 share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('album.show', $album->slug)) }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="text-blue-500 hover:text-blue-600 bi bi-facebook"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                        </svg>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('album.show', $album->slug)) }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="text-blue-500 hover:text-blue-600 bi bi-linkedin"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                        </svg>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($album->titlu) }} - {{ urlencode(route('album.show', $album->slug)) }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="text-blue-500 hover:text-blue-600 bi bi-whatsapp"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-8 text-white bg-gray-800">
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap justify-between">
                <div class="w-full mb-6 md:w-1/3 md:mb-0">
                    <h3 class="mb-2 text-xl font-bold">Click Music</h3>
                    <p class="text-gray-400">Hip-Hop, Soul și Reggae din inima României</p>
                </div>
                <div class="w-full mb-6 md:w-1/3 md:mb-0">
                    <h3 class="mb-2 text-xl font-bold">Link-uri rapide</h3>
                    <ul class="text-gray-400">
                        <li><a href="{{ route('privacy-policy') }}" class="hover:text-white">Politica de
                                confidențialitate</a></li>
                        <li><a href="{{ route('terms-of-service') }}" class="hover:text-white">Termeni și
                                Condiții</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/3">
                    <h3 class="mb-3 text-xl font-bold">Mă găsesti și aici:</h3>
                    <div class="flex mx-auto space-x-4">
                        <a href="https://instagram.com/clickmusic1" target="_blank" rel="noopener noreferrer"
                            class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                fill="currentColor" class="" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                            </svg>
                        </a>

                        <a href="https://www.facebook.com/clickmusicromania" target="_blank"
                            rel="noopener noreferrer" class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                fill="currentColor" class="" viewBox="0 0 16 16">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                            </svg>
                        </a>

                        <a href="https://open.spotify.com/artist/0rbyxJSUfSXjmeW652c41O?si=4I3hPlSITruYO69znEmXFA&nd=1&dlsi=cf9e5847f277482e"
                            target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                fill="currentColor" class="" viewBox="0 0 16 16">
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
