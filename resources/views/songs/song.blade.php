<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $songTitle }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />
</head>
<body class="bg-gray-100">
  <header class="flex flex-col items-center justify-center my-2">
            <a href="/" >
                <img src="/img/logo.png" alt="Logo Click Music" class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
                </a>
            </header>
    <div class="container px-4 py-4 mx-auto">
        {{-- <h1 class="mb-4 text-2xl font-bold text-center">{{ $songTitle }}</h1> --}}
        <div class="max-w-md p-6 mx-auto bg-white rounded shadow-md">
            @if(isset($coverUrl))
                <img src="{{ $coverUrl }}" alt="{{ $songTitle }} Cover" class="w-full mb-4 rounded">
            @endif
            
            
          <div class="mb-4">
    <h2 class="mb-2 text-xl font-semibold text-center">Ascultă sau Descarcă piesa:</h2>
    <div class="bg-gray-100 rounded-lg shadow-md ">
        <audio controls class="w-full">
            <source src="{{ $songUrl }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>
</div>

            <div class="flex justify-center">
                    <a href="{{ $songUrl }}" download class="flex items-center px-6 py-2 font-semibold text-white transition duration-300 bg-blue-500 rounded-full hover:bg-blue-600">
                        <i class="mr-2 fas fa-download"></i> Descarcă
                    </a>
                </div>
            </div>
        </div>
        
          <footer class="py-16 text-sm text-center text-black">
                ClickMusic &copy; {{ date('Y') }}.Toate drepturile rezervate.
                <div class="mt-2">
                    Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank"
                        rel="noopener noreferrer" class="text-blue-500">Click Studios
                        Digital</a>.
                </div>

                <div class="flex-row mt-4">
                    <a href="{{ route('privacy-policy') }}" class="text-blue-500">Politica de
                        confidențialitate</a>
                    |
                    <a href="{{ route('terms-of-service') }}" class="text-blue-500">Termeni și Condiții</a>
                    |
                    <a href="{{ route('contact') }}" class="text-blue-500">Contact</a>
                    |
                    <a href="{{ route('blog.index') }}" class="text-blue-500">Blog</a>
                </div>

            </footer>
                
    </body>

