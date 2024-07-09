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
    <meta property="og:url" content="https://clickmusic.ro/abonament" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ro_RO" />
    <meta property="og:site_name" content="Click Music - Muzica, Hip-Hop, Soul, Reggae" />


    <link rel="canonical" href="https://clickmusic.ro/abonament" />

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

<body class="font-sans antialiased bg-gray-50">
  
 
           <header class="flex flex-col items-center justify-center mt-2 mb-4">
  <a href="{{ route('welcome') }}">
    <img src="/img/logo.png" alt="Logo Click Music"
         class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
  </a>



 <div class="px-2 mt-4 text-white bg-blue-500 rounded">
                    @if (session()->has('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<div>

</header>


<!-- Pricing -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Title -->
    <div class="max-w-2xl mx-auto mb-10 text-center lg:mb-14">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight">Planuri de abonament</h2>
        <p class="mt-1 text-gray-600">Alege planul care ti se potriveste.</p>
    </div>
    <!-- End Title -->

    <!-- Grid -->
    <div class="flex flex-col items-center justify-center gap-6 mt-12 lg:flex-row">
        @if ($user->isEligibleForFreePlan())
            <div class="w-full p-8 mx-auto text-center transition-transform transform border border-gray-200 shadow-md sm:w-80 md:w-64 lg:w-72 rounded-xl hover:shadow-xl hover:scale-105">
                <p class="mb-8">Vi s-a atribuit rolul de <br>
                <span class="px-2 text-white bg-blue-500 rounded">Super_User</span></p>
                <div class="flex justify-center mx-auto text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-person-hearts" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z"/>
                    </svg>
                </div>
                <a href="{{ route('videoclipuri') }}" class="btn btn-primary hover:bg-blue-500 hover:rounded hover:px-2 hover:text-white">ACCES PREMIUM</a>
            </div>
        @else
            <!-- Card -->
            <div class="w-full p-8 text-center transition-transform transform border border-gray-200 shadow-md sm:w-80 md:w-64 lg:w-72 rounded-xl hover:shadow-xl hover:scale-105">
                <h4 class="text-lg font-medium text-gray-800">Lunar</h4>
                <div class="mt-5 text-5xl font-bold text-blue-500">
                    <span class="text-2xl font-bold align-top">Lei</span>
                    9.99
                </div>
                <p class="mt-2 text-sm text-gray-500">Fara nici o obligatie. <br> Anulezi oricand.</p>
                <a href="{{ route('checkout', ['plan' => 'price_1PabyDLHnRRaUZdBk3McKwYs']) }}" class="inline-flex items-center justify-center px-4 py-3 mt-5 text-sm font-semibold text-white bg-blue-500 border border-transparent rounded-lg gap-x-2 hover:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none">
                    Aboneaza-te
                </a>
            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="w-full p-8 text-center transition-transform transform border border-gray-200 shadow-md sm:w-80 md:w-64 lg:w-72 rounded-xl hover:shadow-xl hover:scale-105">
                <h4 class="text-lg font-medium text-gray-800">Anual</h4>
                <div class="mt-5 text-5xl font-bold text-blue-500">
                    <span class="text-2xl font-bold align-top">Lei</span>
                    99.99
                </div>
                <p class="mt-2 text-sm text-gray-500">Platesti pe un an. <br> Ai 2 luni gratis.</p>
                <a href="{{ route('checkout', ['plan' => 'price_1PabyDLHnRRaUZdBXUK6VBns']) }}" class="inline-flex items-center justify-center px-4 py-3 mt-5 text-sm font-semibold text-white bg-blue-500 border border-transparent rounded-lg gap-x-2 hover:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none">
                    Aboneaza-te
                </a>
            </div>
            <!-- End Card -->
        @endif
    </div>
    <!-- End Grid -->

    @if($activeSubscription)
        <div class="mt-8 text-center">
            <p class="mb-2 text-green-600">Ai un abonament activ</p>
            <p class="font-semibold">{{ $activeSubscription->stripe_plan }}</p>

<form action="{{ route('subscription.cancel') }}" method="POST">
    @csrf
    <button type="submit" class="px-2 font-bold text-white bg-red-600 rounded hover:bg-red-500">
      Anulează Abonamentul
    </button>
  </form>

        </div>
    @endif
</div>
<!-- End Pricing -->


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
