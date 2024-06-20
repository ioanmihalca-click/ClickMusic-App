<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termeni și Condiții</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased">
    <div class="text-black bg-gray-50">
        <div class="relative min-h-screen flex flex-col items-center  selection:bg-[#FF2D20] selection:text-white">
            <header class="flex flex-col items-center justify-center mt-2 mb-8">
            <a href="/" >
                <img src="/img/logo.png" alt="Logo Click Music" class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20] mt-8">
                </a>
            </header>
    
        <div class="max-w-md p-6 bg-white rounded-lg shadow-lg">
            <h1 class="mb-4 text-3xl font-bold">Termeni și Condiții</h1>
            <p class="mb-4">Bun venit la Click Music Streaming App. Vă rugăm să citiți cu atenție acești termeni și condiții înainte de a utiliza aplicația noastră.</p>
            <h2 class="mb-2 text-2xl font-semibold">1. Accesul și Utilizarea</h2>
            <p class="mb-4">Prin accesarea și utilizarea aplicației noastre, sunteți de acord să respectați acești termeni și condiții și toate legile și reglementările aplicabile.</p>
            <h2 class="mb-2 text-2xl font-semibold">2. Contul Utilizatorului</h2>
            <p class="mb-4">Pentru a accesa anumite funcționalități ale aplicației, este posibil să fie necesar să vă înregistrați un cont de utilizator. Sunteți responsabil pentru păstrarea confidențialității informațiilor de autentificare ale contului dvs.</p>
            <h2 class="mb-2 text-2xl font-semibold">3. Abonament</h2>
            <p class="mb-4">Pentru acces complet la întreaga colecție de videoclipuri și vloguri, inclusiv premiere în exclusivitate și cele mai noi lansări, este disponibil un abonament la costul de 9,99 lei/lună, sau 99.99 lei/an. Abonamentul poate fi anulat oricând.</p>
            <h2 class="mb-2 text-2xl font-semibold">4. Drepturile de Autor</h2>
            <p class="mb-4">Toate drepturile de autor și alte drepturi de proprietate intelectuală asupra conținutului și materialelor disponibile în aplicație sunt deținute de noi sau de licențiatorii noștri.</p>
            <h2 class="mb-2 text-2xl font-semibold">5. Limitări</h2>
            <p class="mb-4">În niciun caz nu vom fi responsabili pentru orice daune directe, indirecte, speciale, conexe sau punitive sau orice daune, inclusiv, fără limitare, pierderile de profit, venituri, economii sau date rezultate din utilizarea sau imposibilitatea utilizării aplicației noastre.</p>
            <h2 class="mb-2 text-2xl font-semibold">6. Modificări ale Termenilor și Condițiilor</h2>
            <p class="mb-4">Ne rezervăm dreptul de a actualiza sau modifica periodic acești termeni și condiții fără notificare prealabilă. Vă recomandăm să verificați periodic această pagină pentru a fi la curent cu orice modificări.</p>
            <h2 class="mb-2 text-2xl font-semibold">7. Contact</h2>
            <p class="mb-4">Dacă aveți întrebări, nelămuriri sau probleme legate de acești termeni și condiții sau de abonament, vă rugăm să ne contactați la adresa <a href="mailto:contact@clickmusic.ro" class="text-blue-500">contact@clickmusic.ro</a>.</p>
        </div>
    </div>
    <footer class="py-16 text-sm text-center text-black">
                    ClickMusic &copy; {{ date('Y') }}.Toate drepturile rezervate.
                    <div class="mt-2">
                        Aplicație dezvoltată de <a href="https://clickstudios-digital.com" target="_blank" rel="noopener noreferrer"
                            class="text-blue-500">Click Studios
                            Digital</a>.
                    </div>

                    <div class="flex-row mt-4">
                        <a href="{{ route('privacy-policy') }}" class="text-blue-500">Politica de
                            confidențialitate</a>
                        |
                        <a href="{{ route('terms-of-service') }}" class="text-blue-500">Termeni și Condiții</a>
                        |
                        <a href="{{ route('contact') }}" class="text-blue-500">Contact</a>
                    </div>

                </footer>
</body>
</html>
