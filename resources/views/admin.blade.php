
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

<body class="bg-gray-500">
<div class="container p-2">

<livewire:megaphone-admin></livewire:megaphone-admin>


<div class="max-w-2xl p-16 mx-auto mt-4 bg-white rounded">

    <h2 class="mb-4 text-center bg-gray-400 rounded-sm">Trimite o notificare e-mail "Videoclip nou" abonatilor</h2>

    @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

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

</body>
</html>