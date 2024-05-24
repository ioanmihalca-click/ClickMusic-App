<!DOCTYPE html>
<html lang="ro">
    <head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-34NT57GG5F"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-34NT57GG5F');
</script>

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
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div>
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                </a>
            </div>

            <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
