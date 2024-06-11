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
        content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta name="keywords"
        content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video, videoclipuri exclusive" />

    <!-- Open Graph Tags for Social Media Sharing -->
    <meta property="og:title" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />
    <meta property="og:description"
        content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul - Click" />
    <meta property="og:image" content="{{ asset('img/ClickMusic-OG.jpg') }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:alt" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />
    <meta property="og:url" content="https://clickmusic.ro" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />


    <link rel="canonical" href="https://clickmusic.ro" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />


    <title>Click Music - Muzica, Hip-Hop, Soul, Reggae</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

<body class="font-sans antialiased">
    <div class="text-black bg-gray-50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <header class="flex flex-col items-center justify-center mt-2">
                <img src="/img/logo.png" alt="Logo Click Music"
                    class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">

                @if (Route::has('login'))
                    <livewire:welcome.navigation />
                @endif


                {{-- Google Login --}}
                <div class="flex items-center justify-end mt-4">
                    <div>
                        <a href="{{ route('login.google') }}"
                            class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-300 ease-in-out bg-gray-800 rounded-md shadow-md hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="inline-block mr-2 bi bi-google" viewBox="0 0 16 16">
                                <path
                                    d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                            </svg>
                            Sign in with Google
                        </a>
                        <!-- Login with Facebook Button -->
                        {{-- <a href="{{ route('login.facebook') }}" class="btn btn-primary">
                            Login with Facebook
                        </a> --}}

            </header>

            <div class="relative w-full max-w-2xl px-6 mt-2 lg:max-w-7xl">

                <main class="flex items-center justify-center mt-2">
                    <div class="max-w-md mx-auto text-center lg:gap-8">
                        <a href="/register"
                            class="block rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-blue-500/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10">
                            <div class="pt-3 sm:pt-5">
                                <h1 class="text-xl font-semibold">Click Music - Hip-Hop, Soul, Reggae</h1>
                                <h2 class="mt-4 text-base font-semibold ">Bine ai venit pe platforma de streaming Click
                                    Music</h2>


                                <p class="mt-4 text-base">
                                    Pentru a beneficia de acces la întreaga colecție de videoclipuri, inclusiv la cele
                                    mai recente piese in PREMIERA, <span
                                        class ="px-2 text-white bg-blue-500 rounded-md"> înregistrează-te</span> ca
                                    membru al
                                    comunității Click Music. Este
                                    complet gratuit!

                                    <!-- Embedded iframe -->
                                <div class="my-3 overflow-hidden rounded-lg shadow-lg">
                                    <div class="relative" style="padding-top:56.25%;">
                                        <iframe
                                            src="https://iframe.mediadelivery.net/embed/233943/e7750e6c-67fb-44a3-910b-773f7ed3580c?autoplay=true&loop=false&muted=false&preload=false&responsive=true"
                                            loading="lazy" class="absolute inset-0 w-full h-full border-0"
                                            allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;"
                                            allowfullscreen="true">
                                        </iframe>

                                    </div>
                                </div>


                                <h3 class="pl-1 mb-1 text-base font-semibold">Click - Te tin de mana (prod MdBeatz)</h3>

                                <p class="pl-1 text-sm text-gray-600">Vezi mai mult... <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="inline-block w-4 h-4 ml-1 text-blue-500" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9.293 5.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414-1.414L12.586 11H3a1 1 0 0 1 0-2h9.586l-2.293-2.293a1 1 0 0 1 0-1.414z"
                                            clip-rule="evenodd" />
                                    </svg></p>

                            </div>
                        </a>
                    </div>

                </main>

                <!-- Biografie Click -->
                <div x-data="{ open: false }"
                    class="max-w-md mx-auto mt-8 text-left rounded-lg bg-white p-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-blue-500/20 focus:outline-none focus-visible:ring-[#FF2D20] ">

                    <button @click="open = !open">
                        <div class="flex justify-between">
                            <h2 class="text-xl font-semibold text-center text-black">Cine este Click, artistul din
                                spatele muzicii?</h2>
                            <span x-show="!open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">+</span>
                            <span x-show="open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">-</span>
                        </div>

                    </button>
                    <div x-show="open" x-transition>
                        <p class="mt-2 text-base text-black">Click este un artist de muzică hip-hop, soul și reggae
                            stabilit în Baia-Mare, Maramureș. Stilul său muzical este variat, bucurându-se de toate
                            genurile muzicale fără a se limita la unul singur.</p>
                        <p class="mt-2 text-base text-black">A început călătoria muzicală la vârsta de 13 ani, când și-a
                            descoperit pasiunea pentru producția de instrumentale și scrierea versurilor. Încă de la
                            început, a fost încurajat și instruit de Gabi Mican, administratorul portalului de hip-hop
                            “Rap-Arena”. Aceasta colaborare i-a permis să creeze mai multe materiale și să apară pe
                            numeroase compilații de muzică rap.</p>
                        <p class="mt-2 text-base text-black">La 18 ani, s-a mutat la Cluj, unde, împreună cu Blazon și
                            DJ Maka, a format trupa Camuflaj. Aceasta a devenit rapid un simbol al muzicii hip-hop și
                            reggae din Cluj și, ulterior, din toată țara, odată cu mutarea în București și colaborarea
                            cu un label muzical cunoscut. Trupa a câștigat recunoaștere națională cu piese precum
                            "România" și "În Jurul Lumii".</p>
                        <p class="mt-2 text-base text-black">
                            Click și-a lansat primul album solo, "Trup și Suflet", în 2017, urmat de "Lume Dragă" în
                            2020 și
                            EP-urile "Dulce și Amar" și "Culori EP" în 2021. De pe albumul "Trup și Suflet" s-a remarcat
                            piesa "De Dragoste și Război" în colaborare cu El Nino (8 milioane de vizualizări în acest
                            moment), "Prima Dată" în colaborare cu Feli (6 milioane de vizualizări în acest moment), "Pictez" (500 de mii de vizualizari in acest moment), "Speranta" (320 de mii de vizualizari in acest moment) etc.
                            De pe
                            albumul "Lume Dragă" s-a remarcat piesa "Nopțile Calde" în colaborare cu Style da Kid (5
                            milioane de vizualizări în acest moment), "Nici o slabiciune" in colaborare cu Style da Kid si Pacha Man (aproximativ 2 milioane de vizualizari in acest moment) si piesa ce da numele albumului "Lume draga" in colaborare cu Style da Kid si Oana Ciucanu (aproximativ 2 milioane de vizualizari in acest moment). A creat, de asemenea, un material deosebit alături
                            de
                            CDP, un grup format din Style da Kid, Pacha Man și Dragoș Udilă.
                        </p>

                        <p class="mt-2 text-base text-black">Produsele muzicale realizate alaturi de fratele său, Style
                            da
                            Kid,
                            l-au ajutat pe Click să se impună pe scena muzicală din România. În prezent, Click lucrează
                            la finalizarea albumului "Inimă Română" împreună cu Gavrila și Style da Kid, și la un nou
                            album solo care îmbină clasicul cu noul.</p>
                        <p class="mt-2 text-base text-black">
                            Canalul de YouTube al lui Click,
                            <a href="https://youtube.com/clickmusicromania" target="_blank" class="text-blue-500">Click
                                Music Romania</a>,
                            a strâns peste 50 de milioane de vizualizări până în prezent.
                        </p>



                        <h2 class="mt-4 text-xl font-semibold text-black">Cine este omul din spatele artistului?</h2>
                        <p class="mt-2 text-base text-black">
                            Pe lângă cariera sa muzicală, Click este un sportiv dedicat, antrenor și președinte al
                            <a href="https://csvictoriamm.ro/" target="_blank" class="text-blue-500">Clubului Sportiv
                                Victoria
                                Maramureș</a>,
                            unde antrenează copii și adulți în Freestyle Kickboxing și Fitness Funcțional. Este, de
                            asemenea, fondatorul și CEO al agenției de publicitate <a
                                href="https://clickstudios-digital.com" target="_blank" class="text-blue-500">Click
                                Studios Digital</a> din Baia-Mare.
                        </p>
                        <p class="mt-2 text-base text-black">Aceasta este pe scurt povestea lui Click, un artist
                            complex și
                            dedicat, cu o carieră muzicală diversă și un angajament puternic față de comunitate și
                            sport.</p>
                    </div>

                </div>

                <!--Preview videos Welcome -->
                   <div x-data="{ open: false }"
                    class="max-w-md mx-auto mt-8 text-left rounded-lg bg-white p-4 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-blue-500/20 focus:outline-none focus-visible:ring-[#FF2D20] ">

                    <button @click="open = !open">
                        <div class="flex justify-between">
                            <h2 class="mb-4 text-lg font-semibold">Înregistrează-te pentru a avea ACCES la Toate videoclipurile</h2>
                            <span x-show="!open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">+</span>
                            <span x-show="open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">-</span>
                        </div>

                    </button>
                    <div x-show="open" x-transition>
       
        @livewire('welcome-videos')
        </div>
    </div>
      
                   
              

                {{-- Social Links --}}

                <h3 class="mt-8 text-center">Social Links:</h3>
                <div class="flex justify-center p-4">

                    <a href="https://instagram.com/clickmusic1" target="_blank" class="px-4 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                            class="" viewBox="0 0 16 16">
                            <path
                                d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                        </svg>
                    </a>

                    <a href="https://www.facebook.com/clickmusicromania" target="_blank" class="text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                            class="" viewBox="0 0 16 16">
                            <path
                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                        </svg>
                    </a>

                    <a href="https://open.spotify.com/artist/0rbyxJSUfSXjmeW652c41O?si=4I3hPlSITruYO69znEmXFA&nd=1&dlsi=cf9e5847f277482e"
                        target="_blank" class="px-4 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                            class="" viewBox="0 0 16 16">
                            <path
                                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.669 11.538a.5.5 0 0 1-.686.165c-1.879-1.147-4.243-1.407-7.028-.77a.499.499 0 0 1-.222-.973c3.048-.696 5.662-.397 7.77.892a.5.5 0 0 1 .166.686m.979-2.178a.624.624 0 0 1-.858.205c-2.15-1.321-5.428-1.704-7.972-.932a.625.625 0 0 1-.362-1.194c2.905-.881 6.517-.454 8.986 1.063a.624.624 0 0 1 .206.858m.084-2.268C10.154 5.56 5.9 5.419 3.438 6.166a.748.748 0 1 1-.434-1.432c2.825-.857 7.523-.692 10.492 1.07a.747.747 0 1 1-.764 1.288" />
                        </svg>
                    </a>

                    <a href="https://youtube.com/clickmusicromania" target="_blank" class="text-gray-500 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                            class="" viewBox="0 0 16 16">
                            <path
                                d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                        </svg>
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

            </div>
        </div>
    </div>
</body>

</html>
