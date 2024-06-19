<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Server Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="max-w-md p-8 mx-auto bg-white rounded-lg shadow-md">
            <div class="mb-6 text-center">
              
        <h1 class="font-extrabold text-red-500 text-8xl">500</h1>
        <p class="text-4xl font-medium text-gray-800">Internal Server Error</p>
        <p class="mt-4 text-xl text-gray-800">Pagina pe care o cautati nu exista, sau nu sunteti autentificat in aplicatia Click Music.</p>
    </div>
         <div class="text-center">
                <a href="{{ url('/') }}" rel="noopener noreferrer" class="inline-block px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
                    Pagina principala
                </a>
            </div>
            </div>
       
       
        </div>
    </div>
</body>
</html>