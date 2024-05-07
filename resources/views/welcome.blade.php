<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ClickMusic Ro</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    ClickMusic &copy; {{ date('Y') }}. Designed by Elan Media.
                </footer>

            </div>
        </div>
    </div>
</body>

</html>
