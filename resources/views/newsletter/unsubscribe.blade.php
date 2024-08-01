<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dezabonare Newsletter</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md overflow-hidden bg-white rounded-lg shadow-lg">
        <div class="py-4 text-center text-white bg-blue-500">
            <h1 class="text-2xl font-bold">Dezabonare Newsletter</h1>
        </div>
        <div class="p-6">
            @if (isset($success))
                <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                    <span class="block sm:inline">{{ $success }}</span>
                </div>
            @endif

            @if (isset($error))
                <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                    <span class="block sm:inline">{{ $error }}</span>
                </div>
            @endif

            <p class="mb-4 text-gray-700">Dezabonarea a fost procesată cu succes. Dacă dorești să te reabonezi în viitor, poți face acest lucru oricând pe site-ul nostru.</p>
            
            <a href="/" class="inline-block px-4 py-2 font-bold text-white transition duration-300 bg-blue-500 rounded hover:bg-blue-600">
                Înapoi la pagina principală
            </a>
        </div>
    </div>
</body>
</html>