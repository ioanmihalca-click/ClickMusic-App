<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dezabonare Newsletter - Click Music</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <!-- Logo/Header -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-900">Click Music</h1>
            <p class="mt-2 text-gray-600">Gestionare abonament newsletter</p>
        </div>

        @if (isset($success))
            <!-- Success Message -->
            <div class="p-4 mb-6 border border-green-200 rounded-lg bg-green-50">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium text-green-800">{{ $success }}</span>
                </div>
            </div>

            <!-- Resubscribe Option -->
            <div class="p-4 mb-6 border border-blue-200 rounded-lg bg-blue-50">
                <h3 class="mb-2 font-medium text-blue-900">Ai schimbat decizia?</h3>
                <p class="mb-3 text-sm text-blue-800">Te poți reabona oricând la newsletter-ul nostru.</p>

                <form action="{{ route('newsletter.resubscribe') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="email" name="email" placeholder="Adresa ta de email"
                        class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ request('email') }}" required>
                    <button type="submit"
                        class="w-full px-4 py-2 text-white transition duration-200 bg-blue-600 rounded-md hover:bg-blue-700">
                        Reabonează-te
                    </button>
                </form>
            </div>
        @endif

        @if (isset($error))
            <!-- Error Message -->
            <div class="p-4 mb-6 border border-red-200 rounded-lg bg-red-50">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium text-red-800">{{ $error }}</span>
                </div>
            </div>

            <!-- Subscribe Option -->
            <div class="p-4 mb-6 border border-gray-200 rounded-lg bg-gray-50">
                <h3 class="mb-2 font-medium text-gray-900">Vrei să te abonezi?</h3>
                <p class="mb-3 text-sm text-gray-700">Dacă vrei să primești newsletters cu ultimele piese și noutăți, te
                    poți abona aici.</p>

                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="text" name="name" placeholder="Numele tău"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <input type="email" name="email" placeholder="Adresa ta de email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <button type="submit"
                        class="w-full px-4 py-2 text-white transition duration-200 bg-gray-800 rounded-md hover:bg-gray-900">
                        Abonează-te la newsletter
                    </button>
                </form>
            </div>
        @endif

        <!-- Information -->
        <div class="p-4 rounded-lg bg-gray-50">
            <h3 class="mb-2 font-medium text-gray-900">Despre newsletter-ul nostru</h3>
            <ul class="space-y-1 text-sm text-gray-700">
                <li>• Anunțuri despre piese noi</li>
                <li>• Acces prioritar la evenimente</li>
                <li>• Conținut exclusiv din studio</li>
                <li>• Fără spam - doar muzică!</li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="pt-4 mt-6 text-center border-t border-gray-200">
            <a href="{{ route('home') }}" class="text-blue-600 transition duration-200 hover:text-blue-800">
                ← Înapoi la Click Music
            </a>
            <p class="mt-2 text-xs text-gray-500">
                © {{ date('Y') }} Click Music. Toate drepturile rezervate.
            </p>
        </div>
    </div>
</body>

</html>
