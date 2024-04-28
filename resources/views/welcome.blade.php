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
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid items-center grid-cols-2 gap-2 py-10 lg:grid-cols-3">
    <div class="flex lg:flex-col lg:items-center lg:justify-center lg:col-start-2">
    <img src="/img/logo.png" alt="Logo Click Music" class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]">
    @if (Route::has('login'))
        <livewire:welcome.navigation />
    @endif
</div>

</header>


                   <main class="flex items-center justify-center mt-1">
    <div class="text-center lg:gap-8">
        <a
            href="/register"
            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black dark:text-white">Bine ai venit pe platforma Click Music</h2>

                <p class="mt-4 text-base">
                    Pentru a avea acces la toata colectia de videoclipuri inregistreaza-te ca membru a comunitatii noastre. Este gratis!
                </p>
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
