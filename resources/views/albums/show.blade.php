<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Click Music - Magazin | Albume</title>

    <!-- Meta Tags -->
    <meta name="description"
        content="Descoperă albumele artistului Click - muzică Hip-Hop, Reggae, Soul autentică din inima României. Streaming și achiziție de albume digitale.">
    <meta name="keywords" content="Click Music, hip-hop românesc, soul, reggae, albume muzicale, artist român, Baia Mare">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Click Music - Albume Hip-Hop, Reggae, Soul">
    <meta property="og:description"
        content="Explorează colecția de albume a artistului Click - Hip-Hop, Reggae si Soul direct din inima României.">
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG-Magazin.jpg') }}">
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
  "@type": "MusicAlbum",
  "name": "{{ $album->titlu }}",  // Titlul albumului
  "byArtist": {
    "@type": "MusicArtist",
    "name": "Click" 
  },
  "description": "{{ $album->descriere }}",  // Descrierea albumului
  "image": "{{ $album->coverUrl }}", // URL-ul imaginii de copertă
  "datePublished": "@php
                     if($album->data_lansare instanceof \Carbon\Carbon) {
                         echo $album->data_lansare->format('Y-m-d');
                     } else {
                         // Dacă data_lansare este deja un string, îl afișăm direct
                         echo $album->data_lansare;
                     }
                  @endphp", 
  "genre": "{{ $album->gen_muzical }}", // Genul muzical
  "numTracks": {{ $album->numar_trackuri }}, // Numărul de piese
  "offers": {
    "@type": "Offer",
    "price": "{{ $album->pret }}",
    "priceCurrency": "RON",
    "url": "{{ route('album.show', $album->slug) }}", // URL-ul paginii albumului
    "availability": "https://schema.org/InStock" 
  }
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

<body class="font-sans antialiased bg-black">

    <livewire:header-nav />


    <main class="container px-4 py-8 mx-auto">
        <div class="relative mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Gradient ambient în fundal -->
            <div class="absolute inset-0 blur-3xl opacity-30">
                <div class="absolute inset-0 bg-gradient-to-t from-blue-600 via-purple-600 to-blue-800"></div>
            </div>

            <!-- Card Principal -->
            <div
                class="relative p-[0.5px] my-32 bg-gradient-to-t from-blue-500/20 via-purple-500/20 to-blue-500/20 rounded-xl overflow-hidden">
                <div class="p-8 bg-black/90 rounded-xl">
                    <div class="flex flex-col gap-8 md:flex-row">
                        <!-- Imagine Album -->
                        <div class="md:w-1/3">
                            <div class="relative overflow-hidden rounded-lg aspect-square">
                                <img src="{{ asset('storage/' . $album->coperta_album) }}" alt="{{ $album->titlu }}"
                                    class="object-cover w-full h-full transition-all duration-500 hover:scale-105">

                                <!-- Badge Preț -->
                                {{-- <div class="absolute px-4 py-2 rounded-full top-4 right-4 bg-blue-500/80">
                                    <span class="text-sm font-bold text-white">{{ number_format($album->pret, 2) }} RON</span>
                                </div> --}}
                            </div>
                        </div>

                        <!-- Detalii Album -->
                        <div class="md:w-2/3">
                            <h1 class="mb-6 text-3xl font-bold tracking-wider text-white uppercase">{{ $album->titlu }}
                            </h1>

                            <div class="space-y-4 text-gray-300">
                                <p class="text-lg leading-relaxed">{!! $album->descriere !!}</p>

                                <div class="grid grid-cols-2 gap-4 py-4 mt-4 border-t border-white/10">
                                    <div>
                                        <span class="text-gray-400">Gen Muzical:</span>
                                        <p class="text-white">{{ $album->gen_muzical }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">Număr trackuri:</span>
                                        <p class="text-white">{{ $album->numar_trackuri }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">An lansare:</span>
                                        <p class="text-white">
                                            {{ \Carbon\Carbon::parse($album->data_lansare)->format('Y') }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">Pret:</span>
                                        <p class="text-white">{{ number_format($album->pret, 2) }} RON</p>
                                    </div>
                                </div>

                                <!-- Formular Cumpărare -->
                                <form action="{{ route('album.checkout', $album) }}" method="POST"
                                    class="mt-6 space-y-4">
                                    @csrf
                                    <input type="email" name="email" placeholder="Adresa ta de email" required
                                        class="w-full px-4 py-3 text-white placeholder-gray-400 border rounded-lg bg-white/10 border-white/20 focus:border-blue-500 focus:ring-blue-500">

                                    <button type="submit"
                                        class="w-full px-6 py-3 text-sm font-semibold tracking-wider text-white uppercase transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-black">
                                        Cumpără Albumul
                                    </button>
                                </form>

                                <!-- Share Buttons -->
                                <div class="pt-6 mt-6 border-t border-white/10">
                                    <p class="mb-4 text-gray-400">Distribuie acest album:</p>
                                    <div class="flex gap-4">
                                        <!-- Facebook -->
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('album.show', $album->slug)) }}"
                                            target="_blank" rel="noopener noreferrer"
                                            class="p-2 transition-colors duration-300 rounded-full bg-white/10 hover:bg-blue-600">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                            </svg>
                                        </a>

                                        <!-- LinkedIn -->
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('album.show', $album->slug)) }}"
                                            target="_blank" rel="noopener noreferrer"
                                            class="p-2 transition-colors duration-300 rounded-full bg-white/10 hover:bg-blue-600">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                            </svg>
                                        </a>

                                        <!-- WhatsApp -->
                                        <a href="https://api.whatsapp.com/send?text={{ urlencode($album->titlu) }} - {{ urlencode(route('album.show', $album->slug)) }}"
                                            target="_blank" rel="noopener noreferrer"
                                            class="p-2 transition-colors duration-300 rounded-full bg-white/10 hover:bg-blue-600">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
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
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>
