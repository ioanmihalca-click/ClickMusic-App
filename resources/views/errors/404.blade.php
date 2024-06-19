<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="max-w-md p-8 mx-auto bg-white rounded-lg shadow-md">
            <div class="mb-6 text-center">
                <h1 class="mb-4 text-4xl font-bold text-gray-800">404</h1>
                <p class="text-gray-600">Pagina pe care o cautati nu exista, sau nu sunteti autentificat in aplicatia Click Music.</p>
            </div>
       
            <div class="text-center">
                <a href="{{ url('/') }}" rel="noopener noreferrer" class="inline-block px-4 py-2 font-semibold text-white bg-indigo-500 rounded hover:bg-indigo-600">
                    Pagina principala
                </a>
            </div>
        </div>
    </div>
</body>
</html>