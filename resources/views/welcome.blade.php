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
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <!-- Font Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    

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

<div 
     x-data="{ loading: true }"
     x-init="$nextTick(() => { setTimeout(() => loading = false, 700) })"
     class="relative h-screen overflow-hidden">

    <!-- Loading Spinner -->
    <div x-show="loading" class="absolute inset-0 z-50 flex items-center justify-center bg-white">
        <div class="w-16 h-16 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
    </div>


       <!-- Fixed right-side "Ce e nou?" button -->
<div x-data="floatingButton()" x-init="init()" id="floating-button" class="fixed right-0 z-50 transition-all duration-300 ease-in-out" :style="{ bottom: `${bottomPosition}px` }">
    <div class="p-2 bg-white rounded-l-lg shadow-lg">
        <x-slider-intro>
            <x-slot name="trigger">
                <!-- conținutul trigger-ului -->
            </x-slot>
        </x-slider-intro>
    </div>
</div>



    <div x-show="!loading" x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         class="relative h-screen bg-white home-parallax home-fade">
    <div class="relative h-screen bg-white home-parallax home-fade">
        <div class="absolute inset-0">
           <img src="{{ asset('img/hero-large.webp') }}"
 
     alt="Click Music Romania" 
     class="object-cover w-full h-full object-right-30 opacity-35 md:object-center">
        </div>
        <div class="relative z-10 flex items-center justify-center h-full text-gray-700 caption-content">
            <div class="text-center">
                <h1 class="font-roboto-condensed uppercase mb-3 tracking-[6px] md:tracking-[20px] font-bold text-4xl md:text-5xl leading-relaxed md:leading-normal">
                    Click Music Romania
                </h1>
                <h2 class="mb-12 text-xl text-gray-700 uppercase font-roboto-condensed md:text-3xl">Hip-Hop • Reggae • Soul</h2>


                <a href="#despre" class="px-10 py-2 text-xs tracking-widest text-gray-700 uppercase transition-all duration-300 border border-blue-500 scroll-link hover:bg-blue-500 hover:text-white font-roboto-condensed hover:border-transparent">Afla mai multe</a>

            

            </div>
           
        </div>
    </div>
</div>
    </div>
</div>




    <main id="despre" class="container px-4 py-12 mx-auto">
        <div class="max-w-2xl mx-auto">

          
   <section class="mb-12 overflow-hidden transition-all duration-300 transform bg-white">
    <div class="relative p-8 md:p-12">
        <div class="absolute inset-0"></div>
        <div class="relative z-10 text-center">
            <div class="flex justify-center mb-6">
                <img src="/img/Poza Click optimizata.jpg" alt="Click" class="w-32 h-32 border-4 border-blue-500 rounded-full shadow-lg md:w-36 md:h-36">
            </div>
            <p class="mb-6 text-base tracking-widest text-gray-700 uppercase font-roboto-condensed md:text-2xl">Bine ai venit!</p>
            <h3 class="mb-6 text-base tracking-widest text-gray-700 uppercase font-roboto-condensed md:text-2xl">Streaming Video <br> Blog si Magazin Click Music</h3>

            <p class="mb-6 text-base leading-relaxed text-gray-700 md:text-lg">
                Salut! Sunt Click, un artist de muzică hip-hop reggae din inima României.
                Te invit să mă cunoști răsfoind <a href="/blog" class="font-semibold text-blue-500 hover:text-blue-600">Blogul</a> sau ascultându-mi
                muzica gratuit pe <a href="https://youtube.com/clickmusicromania" target="_blank" rel="noopener noreferrer" class="font-semibold text-blue-500 hover:text-blue-600">YouTube</a>. Poți să mă
                susții prin achiziționarea de albume digitale și tricouri din
                <a href="/magazin" class="font-semibold text-blue-500 hover:text-blue-600">Magazin</a> sau
                prin <a href="/accespremium" class="font-semibold text-blue-500 hover:text-blue-600">Acces Premium</a>.
            </p>

            <div class="justify-center mb-32 mt-18 animate-pulse">
                <div class="w-full mx-auto">
                    <div class="text-3xl text-center text-black hover:text-gray-500">
                        <a href="#newsletter" class="flex items-center justify-center scroll-link">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div id="newsletter" class="max-w-md py-20 mx-auto mt-48">
                @if (session('success'))
                    <div class="mt-4 text-green-500">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="mt-4 text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2 class="mt-12 mb-6 text-base tracking-widest text-gray-700 uppercase font-roboto-condensed md:text-2xl">Abonează-te la newsletter</h2>
                <p class="mt-4 mb-6 leading-8 text-gray-600 text-medium">Trimit un email de fiecare data cand lansez ceva nou pe Youtube</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                        <div class="flex-1">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Numele tău</label>
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="block w-full px-4 py-2 text-sm text-gray-900 transition duration-300 ease-in-out border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 hover:bg-white"
                                placeholder="Introdu numele tău">
                        </div>
                        <div class="flex-1">
                            <label for="email-address" class="block mb-2 text-sm font-medium text-gray-700">Adresa de email</label>
                            <input id="email-address" name="email" type="email" autocomplete="email" required
                                class="block w-full px-4 py-2 text-sm text-gray-900 transition duration-300 ease-in-out border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 hover:bg-white"
                                placeholder="Adaugă emailul tău">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                            class="w-32 rounded-md bg-blue-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500 transition-colors duration-300">
                            Abonează-te
                        </button>
                    </div>
                    <p class="mt-3 text-sm"><a href="{{ route('privacy-policy') }}" class="text-sm text-blue-500 md:text-medium hover:text-blue-600">Politica de confidențialitate</a></p>
                </form>

                <div class="justify-center mt-24 mb-32 animate-pulse">
                    <div class="w-full mx-auto">
                        <div class="text-3xl text-center text-black hover:text-gray-500">
                            <a href="#accespremium" class="flex items-center justify-center scroll-link">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="accespremium" class="py-16 mt-48"></div>
            <h2 class="mb-6 text-base tracking-widest text-gray-700 uppercase font-roboto-condensed md:text-2xl">Acces Premium</h2>
            <p class="mb-8 text-lg text-gray-700">
                Pentru <span class="font-semibold text-blue-500">Acces Premium</span> la download-uri și la întreaga colecție de videoclipuri,
                inclusiv cele mai recente lansări și PREMIERE exclusive, abonează-te pentru doar <br>
                <span class="font-semibold text-blue-600">9,99 lei/ lună.</span>
            </p>
            @if (Route::has('login'))
                <div class="mb-8">
                    <livewire:welcome.navigation />
                </div>
            @endif

            <div class="flex justify-center">
                <a href="{{ route('login.google') }}"
                    class="flex items-center justify-center px-4 py-2 text-gray-700 transition duration-300 ease-in-out transform bg-white border border-gray-300 rounded-full shadow-md hover:bg-gray-50 hover:text-blue-500 hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="mr-4 bi bi-google" viewBox="0 0 16 16">
                        <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                    </svg>
                    <span class="text-base font-medium">Loghează-te Google</span>
                </a>
            </div>
        </div>
    </div>
</section>

<div class="justify-center mt-12 mb-32 animate-pulse">
    <div class="w-full mx-auto ">
        <div class="text-3xl text-center text-black hover:text-gray-500">
            <a href="#blogposts" class="flex items-center justify-center scroll-link">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
        </div>
    </div>
</div>
</div>
<section id="blogposts" class="py-16 mt-48 mb-16 overflow-hidden">

                    <!--Latest Blog Posts -->
                    <div class="max-w-6xl mx-auto">
                        <h3 class="mb-8 text-base tracking-widest text-center text-gray-700 uppercase font-roboto-condensed md:text-2xl">Ultimele Articole pe
                            Blog
                        </h3>
                        @livewire('latest-blog-posts')
                    </div>

            </section>


<div x-data="{
activeAccordion: '',
setActiveAccordion(id) {
this.activeAccordion = (this.activeAccordion == id) ? '' : id
}
}" class="relative max-w-2xl mx-auto overflow-hidden text-sm font-normal bg-white border border-gray-200 divide-y divide-gray-200 rounded-md">
<div x-data="{ id: $id('accordion') }" class="cursor-pointer group">
<button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline">
        <h3 class="text-sm tracking-widest uppercase md:text-lg font-roboto-condensed">Cine este Click? <br class="md:hidden"> artistul din spatele muzicii</h3>
<svg class="w-4 h-4 duration-200 ease-out" :class="{ 'rotate-180': activeAccordion==id }" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
</button>
<div x-show="activeAccordion==id" x-collapse x-cloak>
<div class="p-4 pt-0">
  <p class="mt-2 text-base text-black">Click este un artist de muzică hip-hop, reggae și soul stabilit în Baia-Mare, Maramureș. Stilul său muzical este variat, bucurându-se de toate genurile muzicale fără a se limita la unul singur.</p>
        <p class="mt-2 text-base text-black">A început călătoria muzicală la vârsta de 13 ani, când și-a descoperit pasiunea pentru producția de instrumentale și scrierea versurilor. Încă de la început, a fost încurajat și instruit de Gabi Mican, administratorul portalului de hip-hop “Rap-Arena”. Aceasta colaborare i-a permis să creeze mai multe materiale și să apară pe numeroase compilații de muzică rap.</p>
        <p class="mt-2 text-base text-black">La 18 ani, s-a mutat la Cluj, unde, împreună cu Blazon și DJ Maka, a format trupa Camuflaj. Aceasta a devenit rapid un simbol al muzicii hip-hop și reggae din Cluj și, ulterior, din toată țara, odată cu mutarea în București și colaborarea cu un label muzical cunoscut. Trupa a câștigat recunoaștere națională cu piese precum "România" și "În Jurul Lumii".</p>

        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/D_BxEKzY_9k?si=bUttmiFssChkfNHY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">Click și-a lansat primul album solo, <br> "Trup și Suflet", în 2017 <br> (<a href="https://youtu.be/qzzeGDeeo4Y?si=oimnxAeKHp1Zfv4V" target="_blank" rel="noopener noreferrer" class="px-2 text-white bg-blue-500 rounded">Asculta aici</a>), <br> urmat de "Lume Dragă" în 2020 <br> (<a href="https://youtu.be/ME0qVN8aRDA?si=aPHf-NHyrv5huDRH" target="_blank" rel="noopener noreferrer" class="px-2 text-white bg-blue-500 rounded">Asculta aici</a>) <br> și EP-urile "Dulce și Amar" <br> (<a href="https://youtube.com/playlist?list=PLROBgwG4dMG71NFY5lJhbW_puA1o5mYhc&si=DYdjwLqYX_tE2KfE" target="_blank" rel="noopener noreferrer" class="px-2 text-white bg-blue-500 rounded">Asculta aici</a>) <br> și "Culori EP" in colaborare cu MdBeatz în 2021. <br> (<a href="https://youtube.com/playlist?list=PLROBgwG4dMG7P50sEumQrRiaIjOZdIZHk&si=XuhinKO-m-JrKUX_" target="_blank" rel="noopener noreferrer" class="px-2 text-white bg-blue-500 rounded">Asculta aici</a>) <br>

        <p class="mt-2 text-base text-black">De pe albumul "Trup și Suflet" s-a remarcat piesa "De Dragoste și Război" în colaborare cu El Nino</p>
        
        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/3QBXjL79pwc?si=Ntc90qhUBVJma26r" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">"Prima Dată" în colaborare cu Feli,</p>

        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/AyNGsax5LcY?si=HhRRQzHXSouBK79w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">"Pictez",</p>

        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/55_l1jxFe2A?si=HtG5o6PASFRjG9F_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">"Speranta"</p>

        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/ahP0Py7zhJY?si=o3avtKEAkrZtE1YH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">De pe albumul "Lume Dragă" s-a remarcat piesa "Nopțile Calde" în colaborare cu Style da Kid,</p>

        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/zwqfdK1kjzI?si=SJWz68DwBnlqzSRP" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">"Nici o slabiciune" in colaborare cu Style da Kid si Pacha Man</p>

        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/-C5nv4JNlE4?si=cVUo3P3IAOwef_53" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">si piesa ce da numele albumului "Lume draga" in colaborare cu Style da Kid si Oana Ciucanu.</p>

        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/vSeB96h6kEQ?si=v2AK9wBKyaXtXUPF" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">A creat, de asemenea, un material deosebit alături de CDP, un grup format din Style da Kid, Pacha Man și Dragoș Udilă.</p>

        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/TzzJOMAm--qi9cJj" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">Produsele muzicale realizate alaturi de fratele său, Style da Kid, l-au ajutat pe Click să se impună pe scena muzicală din România. <br> În prezent, Click lucrează la finalizarea albumului "Inima Română" împreună cu Gavrila și Style da Kid,</p>

        <div class="relative mt-4" style="padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/YLSurPvOsAUz_Pz4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="absolute top-0 left-0 w-full h-full"></iframe>
        </div>

        <p class="mt-2 text-base text-black">și la un nou album solo care îmbină clasicul cu noul.</p>
        <p class="mt-2 text-base text-black">Canalul de YouTube al lui Click, <a href="https://youtube.com/clickmusicromania" target="_blank" class="text-blue-500">Click Music Romania</a>, a strâns peste 50 de milioane de vizualizări până în prezent.</p>

        <h4 class="mt-4 text-lg font-semibold text-black">Cine este omul din spatele artistului?</h4>
        <p class="mt-2 text-base text-black">Pe lângă cariera sa muzicală, Click este un sportiv dedicat, antrenor și președinte al <a href="https://csvictoriamm.ro/" target="_blank" class="text-blue-500">Clubului Sportiv Victoria Maramureș</a>, unde antrenează copii și adulți în Freestyle Kickboxing și Fitness Funcțional. Este, de asemenea, fondatorul și CEO al agenției de publicitate <a href="https://clickstudios-digital.com" target="_blank" class="text-blue-500">Click Studios Digital</a> din Baia-Mare.</p>
        <p class="mt-2 text-base text-black">Aceasta este pe scurt povestea lui Click, un artist complex și dedicat, cu o carieră muzicală diversă și un angajament puternic față de comunitate și sport.</p>
  
</div>
</div>


    </main>
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

<!--Cookies -->
<div x-data="cookieConsent()" x-show="bannerVisible" 
     x-transition:enter="transition ease-out duration-500" 
     x-transition:enter-start="opacity-0 translate-y-full" 
     x-transition:enter-end="opacity-100 translate-y-0" 
     x-transition:leave="transition ease-in duration-300" 
     x-transition:leave-start="opacity-100 translate-y-0" 
     x-transition:leave-end="opacity-0 translate-y-full" 
     class="fixed inset-0 flex items-center justify-center p-4 duration-300 ease-out" 
     x-cloak>
    <div class="w-full max-w-md p-6 mx-auto bg-white border shadow-lg rounded-xl">
        <div class="flex flex-col items-center text-center text-neutral-600">
            <img src="https://cdn-icons-png.flaticon.com/512/9004/9004938.png" class="w-16 h-16 mb-4" alt="Cookie Icon">
            <h4 class="mb-2 text-xl font-bold text-neutral-900">Notificare privind cookie-urile</h4>
            <p class="mb-6 text-sm">Folosim cookie-uri pentru a îmbunătăți experiența ta online. Continuând navigarea, ești de acord cu utilizarea cookie-urilor pentru îmbunătățirea experienței tale pe site.</p>
        </div>
        <div class="flex justify-center space-x-3">
            <button @click="denyCookies()" class="px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border-2 rounded-md text-neutral-600 hover:text-neutral-700 border-neutral-950 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:outline-none">
                Refuz
            </button>
            <button @click="acceptCookies()" class="px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 border-2 rounded-md bg-neutral-950 border-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:outline-none">
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
            document.cookie = `cookieConsent=${consent}; max-age=${60*60*24*365}; path=/; SameSite=Lax`;
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
                this.bottomPosition = this.footerHeight - distanceToFooter + 32;
            } else {
                this.bottomPosition = 32;
            }
        }
    }
}
</script>

</body>
</html>
