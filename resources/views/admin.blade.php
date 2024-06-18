
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
<h1 class='mb-4 text-center bg-gray-400 rounded-sm'>Trimite o notificare abonatilor</h1>
<livewire:megaphone-admin></livewire:megaphone-admin>
</div>
</body>
</html>