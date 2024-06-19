
<!DOCTYPE html>
<html lang="ro">

<head>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon" />

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" type="image/x-icon" />


    <title>Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="bg-gray-200">

<div class="text-black bg-gray-200">
        <div
            class="relative flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <header class="flex flex-col items-center justify-center mt-2">
                <img src="/img/logo.png" alt="Logo Click Music"
                    class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
                    </header>
                    <h1 class="px-2 my-8 text-2xl font-bold text-center text-blue-500 bg-gray-100 rounded">Admin - Panou de control</h1>
                    </div>
                    </div>

<div x-data="{ open: false }" class="max-w-2xl p-4 mx-auto mt-4 bg-white rounded">
  <button @click="open = !open">
  <div class="flex justify-between">
   <h2 class="text-xl font-semibold text-center text-black">Trimite o notificare abonatilor</h2>
                            <span x-show="!open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">+</span>
                            <span x-show="open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">-</span>
                        </div>

                    </button>
    <div x-show="open" x-transition>
<livewire:megaphone-admin></livewire:megaphone-admin>
</div>
</div>


<div x-data="{ open: false }" class="max-w-2xl p-4 mx-auto mt-4 bg-white rounded ">
  <button @click="open = !open">
    <div class="flex justify-between">
    <h2 class="text-xl font-semibold text-center text-black">Trimite un e-mail abonatilor - "Videoclip nou" </h2>
  <span x-show="!open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">+</span>
                            <span x-show="open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">-</span>
                        </div>
         </button>


    @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
<div x-show="open" x-transition>
    <form action="{{ route('send.notification') }}" method="POST" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
        @csrf

        <div class="mb-4">
            <label for="videoName" class="block mb-2 text-sm font-bold text-gray-700">Nume Videoclip:</label>
            <input type="text" name="videoName" id="videoName" value="{{ old('videoName') }}" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            @error('videoName') 
                <span class="text-xs italic text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="videoUrl" class="block mb-2 text-sm font-bold text-gray-700">URL Videoclip:</label>
            <input type="text" name="videoUrl" id="videoUrl" value="{{ old('videoUrl') }}" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            @error('videoUrl') 
                <span class="text-xs italic text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="imageUrl" class="block mb-2 text-sm font-bold text-gray-700">URL Imagine Copertă:</label>
            <input type="text" name="imageUrl" id="imageUrl" value="{{ old('imageUrl') }}" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            @error('imageUrl') 
                <span class="text-xs italic text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                Trimite Email
            </button>
        </div>
    </form>
</div>

</div>


</div>

</body>
</html>