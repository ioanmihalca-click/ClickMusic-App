<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Meta Tags for Click Music Streaming App -->
<meta name="description" content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul Click din Baia Mare, Maramureș, Romania" />
<meta name="keywords" content="Click Music, streaming video, hip-hop, reggae, soul, Click, Baia Mare, Maramureș, Romania, muzică, videoclipuri muzicale, artist, streaming, audio, video" />

<!-- Open Graph Tags for Social Media Sharing -->
<meta property="og:title" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />
<meta property="og:description" content="Click Music - Muzica, Hip-Hop, Soul, Reggae - O aplicație de streaming video a artistului de muzică hip-hop, reggae și soul Click din Baia Mare, Maramureș, Romania" />
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

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-34NT57GG5F"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-34NT57GG5F');
</script>

</head>

<body class="font-sans antialiased">
    <div class="text-black bg-gray-50 dark:bg-black dark:text-white/50">
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
                    <a href="{{ route('login.google') }}"
                        class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-300 ease-in-out bg-gray-800 rounded-md shadow-md hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="inline-block mr-2 bi bi-google" viewBox="0 0 16 16">
                            <path
                                d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                        </svg>
                        Sign in with Google
                    </a>

            </header>

            <div class="relative w-full max-w-2xl px-6 mt-2 lg:max-w-7xl"> <!-- Adjusted margin-top here -->

                <main class="flex items-center justify-center mt-2"> <!-- Adjusted margin-top here -->
                    <div class="max-w-md mx-auto text-center lg:gap-8">
                        <a href="/register"
                            class="block rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-blue-500/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Bine ai venit pe platforma
                                    Click Music</h2>

                                <p class="mt-4 text-base">
                                    Pentru a beneficia de acces la întreaga noastră colecție de videoclipuri și la
                                    premiere exclusive, înregistrează-te ca membru al comunității noastre. <br> Este
                                    complet gratuit!
                                </p>
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

                <footer class="py-16 text-sm text-center text-black dark:text-white/70">
                    ClickMusic &copy; {{ date('Y') }}. Aplicație dezvoltată de <a
                        href="https://clickstudios-digital.com" target="_blank" class="text-blue-500">Click Studios
                        Digital</a>.
                    <div class="flex-row mt-2">
                        <a href="{{ route('privacy-policy') }}" class="text-blue-500">Politica de confidențialitate</a>
                        |
                        <a href="{{ route('terms-of-service') }}" class="text-blue-500">Termeni și Condiții</a>
                    </div>
                </footer>



            </div>
        </div>
    </div>
</body>

</html>
