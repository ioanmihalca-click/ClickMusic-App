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

    <!-- Additional Styles -->
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

</head>

<body class="px-2 bg-gray-200">

    <div class="text-black bg-gray-200">
        <div class="relative flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <header class="flex flex-col items-center justify-center mt-2">
                <a href="/">
                    <img src="/img/logo.png" alt="Logo Click Music"
                        class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
                </a>
            </header>
            <h1 class="px-2 my-8 text-2xl font-bold text-center text-blue-500 bg-gray-100 rounded">Admin - Panou de
                control</h1>
        </div>
    </div>
  <div class="flex flex-col justify-between max-w-5xl p-4 mx-auto bg-gray-100 rounded md:flex-row">
    <!-- Secțiunea pentru gestionarea notificărilor -->
    <div class="md:pr-4 md:w-1/2">
        <div class="relative flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white mb-4">
            <h2 class="px-2 text-xl font-bold text-center text-blue-500 bg-gray-100 rounded">Gestionare notificari</h2>
        </div>

        <div x-data="{ open: false }" class="max-w-md p-2 mb-4 bg-white rounded-md shadow-md">
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

        <div x-data="{ open: false }" class="max-w-md p-2 bg-white rounded-md shadow-md">
            <button @click="open = !open">
                <div class="flex justify-between">
                    <h2 class="text-xl font-semibold text-center text-black">Trimite e-mail - "Videoclip nou"</h2>
                    <span x-show="!open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">+</span>
                    <span x-show="open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">-</span>
                </div>
            </button>
            @if (session('notification_success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                    {{ session('notification_success') }}
                </div>
            @endif
            <div x-show="open" x-transition>
                <form action="{{ route('send.notification') }}" method="POST" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
                    @csrf
                    <div class="mb-4">
                        <label for="videoName" class="block mb-2 text-sm font-bold text-gray-700">Nume Videoclip:</label>
                        <input type="text" name="videoName" id="videoName" value="{{ old('videoName') }}"
                               class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                        @error('videoName')
                            <span class="text-xs italic text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="videoUrl" class="block mb-2 text-sm font-bold text-gray-700">URL Videoclip:</label>
                        <input type="text" name="videoUrl" id="videoUrl" value="{{ old('videoUrl') }}"
                               class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                        @error('videoUrl')
                            <span class="text-xs italic text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="imageUrl" class="block mb-2 text-sm font-bold text-gray-700">URL Imagine Copertă:</label>
                        <input type="text" name="imageUrl" id="imageUrl" value="{{ old('imageUrl') }}"
                               class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                        @error('imageUrl')
                            <span class="text-xs italic text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                            Trimite Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Secțiunea pentru gestionarea videoclipurilor -->
    <div class="mt-4 md:pl-4 md:mt-0 md:w-1/2">
        <div class="relative flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white mb-4">
            <h2 class="px-2 text-xl font-bold text-center text-blue-500 bg-gray-100 rounded">Gestionare videoclipuri</h2>
        </div>

        <section x-data="{ open: false }" id="adaugare-video" class="max-w-md p-2 mb-4 bg-white rounded-md shadow-md">
            <button @click="open = !open">
                <div class="flex justify-between">
                    <h2 class="text-xl font-semibold text-center text-black">Adaugă videoclip nou</h2>
                    <span x-show="!open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">+</span>
                    <span x-show="open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">-</span>
                </div>
            </button>
            @if (session('success'))
                <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div x-show="open" x-transition>
                <form action="{{ route('videos.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block mb-2 font-bold text-gray-700">Titlu:</label>
                        <input type="text" name="title" id="title"
                               class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block mb-2 font-bold text-gray-700">Descriere:</label>
                        <textarea name="description" id="description"
                                  class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                  required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="embed_link" class="block mb-2 font-bold text-gray-700">Embed Link:</label>
                        <input type="text" name="embed_link" id="embed_link"
                               class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="thumbnail_url" class="block mb-2 font-bold text-gray-700">Thumbnail URL:</label>
                        <input type="text" name="thumbnail_url" id="thumbnail_url"
                               class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                               required>
                    </div>
                    <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                        Adaugă Videoclip
                    </button>
                </form>
            </div>
        </section>

        <section x-data="{ open: false }" id="lista-videoclipuri" class="max-w-md p-2 bg-white rounded-md shadow-md">
            <button @click="open = !open">
                <div class="flex justify-between">
                    <h2 class="text-xl font-semibold text-center text-black">Sterge Videoclipuri</h2>
                    <span x-show="!open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">+</span>
                    <span x-show="open" class="pb-2 ml-2 text-2xl font-semibold text-blue-500">-</span>
                </div>
            </button>
            @if (session('success_delete'))
                <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                    {{ session('success_delete') }}
                </div>
            @endif
            <div x-show="open" x-transition>
                @if ($videos->count() > 0)
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($videos as $video)
                            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full">
                                <div class="p-4">
                                    <h3 class="mb-2 text-lg font-semibold">{{ $video->title }}</h3>
                                    <form action="{{ route('videos.destroy', $video) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Șterge</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Nu există videoclipuri încă.</p>
                @endif
            </div>
        </section>
    </div>
</div>


    </div>

</body>

</html>
