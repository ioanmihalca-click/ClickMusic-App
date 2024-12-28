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
        content="Click, Click Music, muzică românească, hip hop românesc, reggae românesc, muzică Baia Mare, Maramureș, artist independent, streaming muzică, albume digitale, videoclipuri muzicale, download MP3, concerte Click, versuri Click, muzică nouă, muzică underground, muzică alternativă, muzică independentă, muzică conștientă, muzică pozitivă, muzică de vară, muzică de petrecere, muzică de relaxare, artist reggae din România, albume hip-hop de ascultat în 2024, muzică pentru relaxare" />


    <!-- Open Graph Tags for Social Media Sharing -->
    <meta property="og:title" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />
    <meta property="og:description"
        content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG-Site.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-hop, Reggae și Soul" />
    <meta property="og:url" content="https://clickmusic.ro" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-hop, Reggae și Soul" />


    <link rel="canonical" href="https://clickmusic.ro" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />


    <title>Click Music - Muzica, Hip-Hop, Reggae, Soul</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" as="style">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom scrollbar styling */
        body::-webkit-scrollbar {
            width: 9px;
        }

        body::-webkit-scrollbar-thumb {
            background-color: #3B82F6;
            border-radius: 3px;
        }

        body::-webkit-scrollbar-track {
            background-color: #d1d5db;
            border-radius: 3px;
        }
    </style>

    <!-- Schema Markup for SEO -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MusicArtist",
  "name": "Click",
  "description": "Click este un artist de muzică hip-hop, reggae și soul din Baia-Mare, Maramureș.",
  "genre": ["Hip-Hop", "Reggae", "Soul"],
  "url": "https://clickmusic.ro",
  "image": "{{ asset('img/ClickMusic-OG-Site.jpg') }}",
  "sameAs": [
    "https://youtube.com/clickmusicromania"
  ],
  "album": [
    {
      "@type": "MusicAlbum",
      "name": "Trup și Suflet",
      "datePublished": "2017"
    },
    {
      "@type": "MusicAlbum",
      "name": "Lume Dragă",
      "datePublished": "2020"
    },
    {
      "@type": "MusicAlbum",
      "name": "Dulce și Amar",
      "albumProductionType": "EP",
      "datePublished": "2021"
    },
    {
      "@type": "MusicAlbum",
      "name": "Culori EP",
      "albumProductionType": "EP",
      "datePublished": "2021",
      "byArtist": [
        {
          "@type": "MusicArtist",
          "name": "Click"
        },
        {
          "@type": "MusicArtist",
          "name": "MdBeatz"
        }
      ]
    },
    {
      "@type": "MusicAlbum",
      "name": "Inima Romana",
      "datePublished": "2024",
      "byArtist": [
        {
          "@type": "MusicArtist",
          "name": "Click"
        },
        {
          "@type": "MusicArtist",
          "name": "Găvrilă"
        }
      ]
    }
  ]
}
</script>

</head>

<body class="font-sans antialiased bg-white">

    <div>
        <livewire:header-nav />
    </div>

    <div x-data="{ loading: true, isMobile: window.innerWidth <= 768 }" x-init="$nextTick(() => {
        setTimeout(() => loading = false, 700);
        window.addEventListener('resize', () => isMobile = window.innerWidth <= 768);
    })" class="relative h-screen overflow-hidden">

        <!-- Loading Spinner -->
        <div x-show="loading" class="absolute inset-0 z-50 flex items-center justify-center bg-black">
            <div class="w-16 h-16 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
        </div>



        <!-- Fixed right-side "Ce e nou?" button -->
        {{-- <div x-data="floatingButton()" x-init="init()" id="floating-button"
            class="fixed right-0 z-50 hidden transition-all duration-300 ease-in-out" :class="{ 'hidden': false }"
            x-cloak :style="{ bottom: `${bottomPosition}px` }">
            <x-slider-intro />
        </div> --}}

        <div x-show="!loading" x-transition:enter="transition ease-out duration-300" x-data="netflixBackground()"
            x-init="init()" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="relative h-screen overflow-hidden bg-black home-parallax home-fade">

            <!-- Poster Background -->
            <div class="absolute inset-0 overflow-hidden poster-container">
                <template x-for="(row, rowIndex) in posterRows" :key="rowIndex">
                    <div class="poster-row"
                        :style="`animation-duration: ${50 + rowIndex * 5}s; transform: translateY(${isMobile ? rowIndex * 25 : rowIndex * 50}px) rotateX(60deg);`">
                        <template x-for="(poster, posterIndex) in row" :key="posterIndex">
                            <div class="poster">
                                <img :src="poster" alt="Click Music"
                                    class="object-cover w-full h-full rounded-lg">
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-black/75"></div>

            <!-- Content Overlay -->
            <div class="relative z-10 flex items-center justify-center h-full text-white caption-content">
                <div class="text-center">
                    <h1
                        class="font-roboto-condensed uppercase mb-3 tracking-[6px] md:tracking-[20px] font-bold text-4xl md:text-5xl leading-relaxed md:leading-normal">
                        Click Music Romania
                    </h1>
                    <h2 class="mb-12 text-xl uppercase font-roboto-condensed md:text-3xl">Hip-Hop • Soul • Reggae</h2>
                    <a href="#despre"
                        class="px-10 py-2 text-xs tracking-widest uppercase transition-all duration-300 border border-blue-500 scroll-link hover:bg-blue-500 hover:text-white font-roboto-condensed hover:border-transparent">Afla
                        mai multe</a>
                </div>
            </div>
        </div>
    </div>


    <main id="despre" class="overflow-hidden text-white bg-black">

        <div class="container px-4 py-16 mx-auto">
            <div class="max-w-3xl mx-auto">
                <section class="mb-16 overflow-hidden transition-all duration-300 transform">
                    <div class="relative shadow-lg p-4rounded-lg md:p-8 bg-opacity-60">
                        <div class="relative z-10 text-center">
                            <div class="flex justify-center mb-8">
                                <img src="/img/Poza Click optimizata.jpg" alt="Click"
                                    class="w-32 h-32 border-4 border-blue-500 rounded-full shadow-lg md:w-40 md:h-40">
                            </div>
                            <p
                                class="mb-4 text-lg tracking-wider text-blue-400 uppercase font-roboto-condensed md:text-2xl">
                                Bine ai venit!
                            </p>
                            <h3
                                class="mb-6 text-xl tracking-wide text-white uppercase font-roboto-condensed md:text-3xl">
                                Streaming Video <br> Blog si Magazin Click Music
                            </h3>

                            <p class="mb-8 text-base leading-relaxed text-gray-300 md:text-lg">
                                Salut! Sunt Click, un artist de muzică hip-hop, soul și reggae din inima României.
                                Te invit să mă cunoști răsfoind <a href="/blog"
                                    class="font-semibold text-blue-400 transition-colors duration-300 hover:text-blue-300">Blogul</a>
                                sau ascultându-mi
                                muzica gratuit pe <a href="https://youtube.com/clickmusicromania" target="_blank"
                                    rel="noopener noreferrer"
                                    class="font-semibold text-blue-400 transition-colors duration-300 hover:text-blue-300">YouTube</a>.
                                Poți să mă
                                susții prin achiziționarea de albume digitale și tricouri din
                                <a href="/magazin"
                                    class="font-semibold text-blue-400 transition-colors duration-300 hover:text-blue-300">Magazin</a>
                                sau
                                devenind parte din Comunitatea mea. Poti face asta aici: <a href="/accespremium"
                                    class="font-semibold text-blue-400 transition-colors duration-300 hover:text-blue-300">Acces
                                    Premium</a>.
                            </p>

                            <div class="relative bg-black">
                                <div class="absolute inset-0 blur-3xl opacity-30">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800">
                                    </div>
                                </div>

                                <div class="max-w-5xl px-6 py-24 mx-auto text-center">
                                    <h2
                                        class="text-3xl font-bold tracking-wide text-transparent uppercase bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 font-roboto-condensed">
                                        Intră în Comunitate
                                    </h2>

                                    <div class="grid gap-8 mt-12 md:grid-cols-3">
                                        <div
                                            class="p-6 transition-all duration-300 border bg-gray-800/50 backdrop-blur border-gray-700/30 rounded-xl hover:scale-105">
                                            <svg class="w-12 h-12 mx-auto mb-4 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            <h3 class="mb-3 text-xl font-semibold text-white">Premiere Exclusive</h3>
                                            <p class="text-gray-300">Fii primul care ascultă piesele noi înainte de
                                                lansarea oficială</p>
                                        </div>

                                        <div
                                            class="p-6 transition-all duration-300 border bg-gray-800/50 backdrop-blur border-gray-700/30 rounded-xl hover:scale-105">
                                            <svg class="w-12 h-12 mx-auto mb-4 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                            </svg>
                                            <h3 class="mb-3 text-xl font-semibold text-white">Forum Comunitate</h3>
                                            <p class="text-gray-300">Discută cu alți susținători și împărtășește păreri
                                                despre
                                                muzică</p>
                                        </div>

                                        <div
                                            class="p-6 transition-all duration-300 border bg-gray-800/50 backdrop-blur border-gray-700/30 rounded-xl hover:scale-105">
                                            <svg class="w-12 h-12 mx-auto mb-4 text-blue-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <h3 class="mb-3 text-xl font-semibold text-white">Acces Direct</h3>
                                            <p class="text-gray-300">Feedback și interacțiune directă cu artistul</p>
                                        </div>
                                    </div>

                                    {{-- <div class="max-w-3xl mx-auto mt-12">
                                        <a href="/accespremium"
                                            class="inline-flex items-center px-8 py-3 text-lg font-medium text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                                            Obține Acces Premium
                                            <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- Newsletter Section -->
        <div id="newsletter" class="max-w-md px-6 py-20 mx-auto mt-48">
            @if (session('success'))
                <div class="mt-4 text-green-400">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="mt-4 text-red-400">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="mt-12 mb-6 text-2xl tracking-widest text-blue-400 uppercase font-roboto-condensed md:text-3xl">
                Abonează-te la newsletter
            </h2>
            <p class="mt-4 mb-6 text-lg leading-8 text-gray-300">Trimit un email de fiecare data cand lansez ceva nou
                pe Youtube</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                    <div class="flex-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Numele tău</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="block w-full px-4 py-2 text-sm text-white transition duration-300 ease-in-out bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700"
                            placeholder="Introdu numele tău">
                    </div>
                    <div class="flex-1">
                        <label for="email-address" class="block mb-2 text-sm font-medium text-gray-300">Adresa de
                            email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="block w-full px-4 py-2 text-sm text-white transition duration-300 ease-in-out bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700"
                            placeholder="Adaugă emailul tău">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="w-32 px-3.5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors duration-300">
                        Abonează-te
                    </button>
                </div>
                <p class="mt-3 text-sm">
                    <a href="{{ route('privacy-policy') }}" class="text-blue-400 hover:text-blue-300">
                        Politica de confidențialitate
                    </a>
                </p>
            </form>
        </div>

        <!-- Centered Bounce Circle -->
        <div class="flex justify-center mb-8">
            <div class="animate-bounce">
                <a href="#accespremium"
                    class="inline-block p-2 transition-colors duration-300 bg-blue-500 rounded-full scroll-link hover:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
            </div>
        </div>



        <!-- Access Premium Section -->
        <div id="accespremium" class="max-w-xl px-6 py-20 mx-auto mt-48 ">
            <div class="max-w-2xl px-4 mx-auto mt-20 text-center">
                <h2 class="mb-6 text-2xl tracking-widest text-blue-400 uppercase font-roboto-condensed md:text-3xl">
                    Acces Premium
                </h2>
                <p class="mb-8 text-lg text-gray-300">
                    Pentru <span class="font-semibold text-blue-400">Acces Premium</span> la download-uri și la
                    întreaga colecție de videoclipuri, inclusiv cele mai recente lansări și PREMIERE exclusive,
                    abonează-te pentru doar<br>
                    <span class="font-semibold text-blue-300">9,99 lei/ lună.</span>
                </p>
                @if (Route::has('login'))
                    <div class="mb-8">
                        <livewire:welcome.navigation />
                    </div>
                @endif


                <div class="flex justify-center">
                    <a href="{{ route('login.google') }}"
                        class="flex items-center justify-center px-6 py-3 text-gray-700 transition duration-300 ease-in-out bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-50 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="mr-3 bi bi-google" viewBox="0 0 16 16">
                            <path
                                d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                        </svg>
                        <span class="text-base font-medium">Sign in with Google</span>
                    </a>
                </div>


            </div>
        </div>

        <!-- Centered Bounce Circle -->
        <div class="flex justify-center mb-8">
            <div class="animate-bounce">
                <a href="#blogposts"
                    class="inline-block p-2 transition-colors duration-300 bg-blue-500 rounded-full scroll-link hover:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Blog Posts Section -->
        <section id="blogposts" class="px-6 py-16 mt-48 mb-16 overflow-hidden ">
            <div class="max-w-5xl mx-auto">
                <h3
                    class="my-8 text-2xl tracking-widest text-center text-blue-400 uppercase font-roboto-condensed md:text-3xl">
                    Ultimele Articole pe Blog
                </h3>
                @livewire('latest-blog-posts')
            </div>
        </section>



        {{-- <div x-data="{
            activeAccordion: '',
            setActiveAccordion(id) {
                this.activeAccordion = (this.activeAccordion == id) ? '' : id
            }
        }"
            class="relative max-w-3xl mx-auto mb-16 overflow-hidden text-sm font-normal text-white bg-black border border-gray-700 rounded-lg shadow-lg bg-opacity-70">
            <div x-data="{ id: $id('accordion') }" class="cursor-pointer group">
                <button @click="setActiveAccordion(id)"
                    class="flex items-center justify-between w-full p-6 text-left transition-colors duration-300 select-none group-hover:bg-blue-500 group-hover:bg-opacity-25">
                    <h3 class="text-lg tracking-wider uppercase md:text-xl font-roboto-condensed">Cine este Click? <br
                            class="md:hidden"> artistul din spatele muzicii</h3>
                    <svg class="w-6 h-6 text-blue-400 transition-transform duration-300 ease-in-out"
                        :class="{ 'rotate-180': activeAccordion == id }" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div x-show="activeAccordion==id" x-collapse x-cloak>
                    <div class="p-6 space-y-4 text-gray-300">
                        <p>Click este un artist de muzică hip-hop, reggae și soul
                            stabilit în Baia-Mare, Maramureș. Stilul său muzical este variat, bucurându-se de toate
                            genurile muzicale fără a se limita la unul singur.</p>
                        <p>A început călătoria muzicală la vârsta de 13 ani, când
                            și-a descoperit pasiunea pentru producția de instrumentale și scrierea versurilor. Încă de
                            la început, a fost încurajat și instruit de Gabi Mican, administratorul portalului de
                            hip-hop "Rap-Arena". Aceasta colaborare i-a permis să creeze mai multe materiale și să apară
                            pe numeroase compilații de muzică rap.</p>
                        <p>La 18 ani, s-a mutat la Cluj, unde, împreună cu Blazon și
                            DJ Maka, a format trupa Camuflaj. Aceasta a devenit rapid un simbol al muzicii hip-hop și
                            reggae din Cluj și, ulterior, din toată țara, odată cu mutarea în București și colaborarea
                            cu un label muzical cunoscut. Trupa a câștigat recunoaștere națională cu piese precum
                            "România" și "În Jurul Lumii".</p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/D_BxEKzY_9k?si=bUttmiFssChkfNHY"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">Click și-a lansat primul album solo, "Trup și
                            Suflet", în 2017 (<a href="https://youtu.be/qzzeGDeeo4Y?si=oimnxAeKHp1Zfv4V"
                                target="_blank" rel="noopener noreferrer"
                                class="px-2 py-1 text-white transition-colors duration-300 bg-blue-600 rounded hover:bg-blue-700">Ascultă
                                aici</a>),
                            urmat de "Lume Dragă" în 2020 (<a href="https://youtu.be/ME0qVN8aRDA?si=aPHf-NHyrv5huDRH"
                                target="_blank" rel="noopener noreferrer"
                                class="px-2 py-1 text-white transition-colors duration-300 bg-blue-600 rounded hover:bg-blue-700">Ascultă
                                aici</a>)
                            și EP-urile "Dulce și Amar" (<a
                                href="https://youtube.com/playlist?list=PLROBgwG4dMG71NFY5lJhbW_puA1o5mYhc&si=DYdjwLqYX_tE2KfE"
                                target="_blank" rel="noopener noreferrer"
                                class="px-2 py-1 text-white transition-colors duration-300 bg-blue-600 rounded hover:bg-blue-700">Ascultă
                                aici</a>)
                            și "Culori EP" in colaborare cu MdBeatz în 2021. (<a
                                href="https://youtube.com/playlist?list=PLROBgwG4dMG7P50sEumQrRiaIjOZdIZHk&si=XuhinKO-m-JrKUX_"
                                target="_blank" rel="noopener noreferrer"
                                class="px-2 py-1 text-white transition-colors duration-300 bg-blue-600 rounded hover:bg-blue-700">Ascultă
                                aici</a>)</p>

                        <p class="mt-4">De pe albumul "Trup și Suflet" s-a remarcat piesa "De
                            Dragoste și Război" în colaborare cu El Nino</p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/3QBXjL79pwc?si=Ntc90qhUBVJma26r"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">"Prima Dată" în colaborare cu Feli,</p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/AyNGsax5LcY?si=HhRRQzHXSouBK79w"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">"Pictez",</p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/55_l1jxFe2A?si=HtG5o6PASFRjG9F_"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">"Speranta"</p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/ahP0Py7zhJY?si=o3avtKEAkrZtE1YH"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">De pe albumul "Lume Dragă" s-a remarcat piesa "Nopțile
                            Calde" în colaborare cu Style da Kid,</p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/zwqfdK1kjzI?si=SJWz68DwBnlqzSRP"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">"Nici o slabiciune" in colaborare cu Style da Kid si Pacha
                            Man</p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/-C5nv4JNlE4?si=cVUo3P3IAOwef_53"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">si piesa ce da numele albumului "Lume draga" in colaborare
                            cu Style da Kid si Oana Ciucanu.</p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/vSeB96h6kEQ?si=v2AK9wBKyaXtXUPF"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">A creat, de asemenea, un material deosebit alături de CDP,
                            un grup format din Style da Kid, Pacha Man și Dragoș Udilă.</p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/TzzJOMAm--qi9cJj" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">Produsele muzicale realizate alaturi de fratele său, Style
                            da Kid, l-au ajutat pe Click să se impună pe scena muzicală din România. <br> În prezent,
                            Click lucrează la finalizarea albumului "Inima Română" împreună cu Gavrila și Style da Kid,
                        </p>

                        <div class="relative mt-4 aspect-video">
                            <iframe src="https://www.youtube.com/embed/YLSurPvOsAUz_Pz4" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="absolute top-0 left-0 w-full h-full rounded-lg"></iframe>
                        </div>

                        <p class="mt-4">și la un nou album solo care îmbină clasicul cu noul.</p>
                        <p class="mt-4">Canalul de YouTube al lui Click, <a
                                href="https://youtube.com/clickmusicromania" target="_blank"
                                class="text-blue-400 transition-colors duration-300 hover:text-blue-300">Click Music
                                Romania</a>, a strâns peste 50 de milioane de
                            vizualizări până în prezent.</p>

                        <h4 class="mt-6 text-xl font-semibold text-white">Cine este omul din spatele artistului?</h4>
                        <p class="mt-2">Pe lângă cariera sa muzicală, Click este un sportiv
                            dedicat, antrenor și președinte al <a href="https://csvictoriamm.ro/" target="_blank"
                                class="text-blue-400 transition-colors duration-300 hover:text-blue-300">Clubului
                                Sportiv Victoria Maramureș</a>, unde antrenează copii și
                            adulți în Freestyle Kickboxing și Fitness Funcțional. Este, de asemenea, fondatorul și CEO
                            al agenției de publicitate <a href="https://clickstudios-digital.com" target="_blank"
                                class="text-blue-400 transition-colors duration-300 hover:text-blue-300">Click Studios
                                Digital</a> din Baia-Mare.</p>
                        <p class="mt-2">Aceasta este pe scurt povestea lui Click, un artist
                            complex și dedicat, cu o carieră muzicală diversă și un angajament puternic față de
                            comunitate și sport.</p>


                    </div>
                </div>
            </div> --}}
        </div>
    </main>

    <x-footer />

    <!--Cookies -->
    <div x-data="cookieConsent()" x-show="bannerVisible" x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-full"
        class="fixed inset-0 flex items-center justify-center p-4 duration-300 ease-out" x-cloak>
        <div class="w-full max-w-md p-6 mx-auto bg-white border shadow-lg rounded-xl">
            <div class="flex flex-col items-center text-center text-neutral-600">
                <img src="https://cdn-icons-png.flaticon.com/512/9004/9004938.png" class="w-16 h-16 mb-4"
                    alt="Cookie Icon">
                <h4 class="mb-2 text-xl font-bold text-neutral-900">Notificare privind cookie-urile</h4>
                <p class="mb-6 text-sm">Folosim cookie-uri pentru a îmbunătăți experiența ta online. Continuând
                    navigarea, ești de acord cu utilizarea cookie-urilor pentru îmbunătățirea experienței tale pe site.
                </p>
            </div>
            <div class="flex justify-center space-x-3">
                <button @click="denyCookies()"
                    class="px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border-2 rounded-md text-neutral-600 hover:text-neutral-700 border-neutral-950 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:outline-none">
                    Refuz
                </button>
                <button @click="acceptCookies()"
                    class="px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 border-2 rounded-md bg-neutral-950 border-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:outline-none">
                    Accept
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cookieConsent', () => ({
                bannerVisible: false,

                init() {
                    if (!this.hasUserConsented()) {
                        setTimeout(() => {
                            this.bannerVisible = true;
                        }, 300);
                    }
                },

                acceptCookies() {
                    this.setUserConsent(true);
                    this.bannerVisible = false;
                },

                denyCookies() {
                    this.setUserConsent(false);
                    this.bannerVisible = false;
                },

                hasUserConsented() {
                    return localStorage.getItem('cookieConsent') !== null;
                },

                setUserConsent(consent) {
                    localStorage.setItem('cookieConsent', consent ? 'true' : 'false');
                    // Set a cookie for server-side consent checking
                    document.cookie =
                        `cookieConsent=${consent}; max-age=${60*60*24*365}; path=/; SameSite=Lax`;
                },

                getUserConsent() {
                    return localStorage.getItem('cookieConsent') === 'true';
                }
            }));
        });
    </script>

    <script>
        function floatingButton() {
            return {
                bottomPosition: 32, // 32px = 8 * 4 (tailwind's bottom-8)
                footerHeight: 0,
                init() {
                    this.footerHeight = document.querySelector('footer').offsetHeight;
                    window.addEventListener('scroll', () => this.updatePosition());
                    this.updatePosition();
                },
                updatePosition() {
                    const scrollPosition = window.pageYOffset;
                    const windowHeight = window.innerHeight;
                    const documentHeight = document.documentElement.scrollHeight;
                    const distanceToFooter = documentHeight - scrollPosition - windowHeight;

                    if (distanceToFooter <= this.footerHeight) {
                        this.bottomPosition = this.footerHeight - distanceToFooter - 52;
                    } else {
                        this.bottomPosition = 32;
                    }
                }
            }
        }
    </script>

    <script>
        document.querySelectorAll('.poster-row').forEach((row, index) => {
            // Adaugă viteze diferite pentru fiecare rând
            row.style.animationDuration = `${60 + (index * 10)}s`;

            // Adaugă un delay aleatoriu la start
            row.style.animationDelay = `-${Math.random() * 60}s`;
        });

        function netflixBackground() {
            return {
                posterRows: [],
                init() {
                    // Add your poster image URLs here
                    const posters = [
                        '/img/poze-bg/1.jpg',
                        '/img/poze-bg/2.jpg',
                        '/img/poze-bg/3.jpg',
                        '/img/poze-bg/4.jpg',
                        '/img/poze-bg/5.jpg',
                        '/img/poze-bg/6.jpg',
                        '/img/poze-bg/7.jpg',
                        '/img/poze-bg/8.jpg',
                        '/img/poze-bg/9.jpg',
                        '/img/poze-bg/10.jpg',
                        '/img/poze-bg/11.jpg',
                        '/img/poze-bg/12.jpg',
                        '/img/poze-bg/13.jpg',
                        '/img/poze-bg/14.jpg',
                        '/img/poze-bg/15.jpg',
                        '/img/poze-bg/16.jpg',
                        '/img/poze-bg/17.jpg',
                        '/img/poze-bg/18.jpg',
                        '/img/poze-bg/19.jpg',
                        '/img/poze-bg/20.jpg',

                        // Add more poster URLs as needed
                    ];

                    // Create 5 rows of posters
                    this.posterRows = Array(5).fill().map(() => {
                        // Shuffle the posters array for each row
                        return [...posters].sort(() => Math.random() - 0.5);
                    });

                    // Double the posters in each row for seamless looping
                    this.posterRows = this.posterRows.map(row => [...row, ...row]);
                }
            };
        }
    </script>

</body>

</html>
