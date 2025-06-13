@php
    use App\Models\Newsletter;
    use App\Models\User;
    use App\Filament\Resources\NewsletterResource;
    use Carbon\Carbon;

    // Statistici combinate
    $combinedStats = NewsletterResource::getCombinedStats();

    // Statistici generale Newsletter
    $totalNewsletters = Newsletter::count();
    $pendingNewsletters = Newsletter::pending()->count();
    $sentNewsletters = Newsletter::sent()->count();
    $failedNewsletters = Newsletter::failed()->count();

    // Statistici utilizatori
    $totalUsers = User::count();
    $subscribedUsers = User::getNewsletterSubscribersCount();
    $unsubscribedUsers = User::whereNotNull('newsletter_unsubscribed_at')->count();

    // Statistici zilnice
    $sentToday = Newsletter::getSentTodayCount();
    $remainingQuota = Newsletter::getRemainingQuota(200);
    $dailyLimit = 200;

    // Rata de succes
    $successRate =
        $sentNewsletters > 0 ? round(($sentNewsletters / ($sentNewsletters + $failedNewsletters)) * 100, 1) : 0;
@endphp

<div class="p-6 space-y-6">
    {{-- Header --}}
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            📊 Statistici Newsletter Complete
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Lista Newsletter + Utilizatori din aplicație
        </p>
    </div>

    {{-- Statistici principale combinate --}}
    <div class="p-6 rounded-lg bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            🎯 Destinatari totali
        </h3>

        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            <div class="text-center">
                <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                    {{ number_format($combinedStats['newsletter_pending']) }}
                </div>
                <div class="text-sm text-blue-800 dark:text-blue-300">
                    Lista Newsletter
                </div>
            </div>

            <div class="text-center">
                <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                    {{ number_format($combinedStats['users_subscribed']) }}
                </div>
                <div class="text-sm text-purple-800 dark:text-purple-300">
                    Utilizatori App
                </div>
            </div>

            <div class="text-center">
                <div class="text-3xl font-bold text-orange-600 dark:text-orange-400">
                    {{ number_format($combinedStats['duplicates']) }}
                </div>
                <div class="text-sm text-orange-800 dark:text-orange-300">
                    Duplicate
                </div>
            </div>

            <div class="p-2 text-center border-2 border-green-200 rounded-lg dark:border-green-800">
                <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                    {{ number_format($combinedStats['total_unique']) }}
                </div>
                <div class="text-sm font-medium text-green-800 dark:text-green-300">
                    <strong>TOTAL UNIC</strong>
                </div>
            </div>
        </div>
    </div>

    {{-- Detalii Newsletter vs Users --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        {{-- Statistici Lista Newsletter --}}
        <div class="p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <h4 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                📧 Lista Newsletter
            </h4>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Total în listă:</span>
                    <span class="font-semibold">{{ number_format($totalNewsletters) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">În așteptare:</span>
                    <span class="font-semibold text-yellow-600">{{ number_format($pendingNewsletters) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Trimise cu succes:</span>
                    <span class="font-semibold text-green-600">{{ number_format($sentNewsletters) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Eșuate:</span>
                    <span class="font-semibold text-red-600">{{ number_format($failedNewsletters) }}</span>
                </div>
            </div>
        </div>

        {{-- Statistici Utilizatori --}}
        <div class="p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <h4 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
                👥 Utilizatori App
            </h4>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Total utilizatori:</span>
                    <span class="font-semibold">{{ number_format($totalUsers) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Abonați la newsletter:</span>
                    <span class="font-semibold text-green-600">{{ number_format($subscribedUsers) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Dezabonați:</span>
                    <span class="font-semibold text-red-600">{{ number_format($unsubscribedUsers) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Rata abonare:</span>
                    <span class="font-semibold text-blue-600">
                        {{ $totalUsers > 0 ? round(($subscribedUsers / $totalUsers) * 100, 1) : 0 }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Limita zilnică --}}
    <div class="p-6 rounded-lg bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            📅 Limita zilnică (200 emailuri/zi)
        </h3>

        <div class="flex items-center justify-between mb-3">
            <span class="text-sm text-gray-600 dark:text-gray-400">
                Progres astăzi: {{ $sentToday }} / {{ $dailyLimit }}
            </span>
            <span class="text-sm font-medium {{ $remainingQuota > 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ $remainingQuota }} rămase
            </span>
        </div>

        <div class="w-full h-3 bg-gray-200 rounded-full dark:bg-gray-700">
            <div class="h-3 transition-all duration-300 rounded-full bg-gradient-to-r from-purple-500 to-pink-500"
                style="width: {{ min(($sentToday / $dailyLimit) * 100, 100) }}%"></div>
        </div>

        @if ($remainingQuota <= 0)
            <div class="p-3 mt-3 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900/30 dark:border-red-800">
                <p class="text-sm text-red-700 dark:text-red-300">
                    ⚠️ Limita zilnică a fost atinsă. Următoarele emailuri se vor trimite mâine dimineață.
                </p>
            </div>
        @else
            <div
                class="p-3 mt-3 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:border-green-800">
                <p class="text-sm text-green-700 dark:text-green-300">
                    ✅ Din {{ $combinedStats['total_unique'] }} destinatari totali,
                    <strong>{{ min($combinedStats['total_unique'], $remainingQuota) }}</strong>
                    se pot trimite astăzi.
                    @if ($combinedStats['total_unique'] > $remainingQuota)
                        Restul de {{ $combinedStats['total_unique'] - $remainingQuota }} se vor trimite mâine.
                    @endif
                </p>
            </div>
        @endif
    </div>

    {{-- Informații utile --}}
    <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
        <h4 class="mb-2 font-medium text-blue-900 dark:text-blue-100">💡 Informații despre sistemul combinat</h4>
        <ul class="space-y-1 text-sm text-blue-800 dark:text-blue-200">
            <li>• <strong>Lista Newsletter:</strong> Adrese adăugate manual în sistemul de newsletter</li>
            <li>• <strong>Utilizatori App:</strong> Toți utilizatorii din aplicație sunt abonați implicit (conform
                termeni)</li>
            <li>• <strong>Duplicate:</strong> Utilizatori care apar în ambele liste (se trimit o singură dată)</li>
            <li>• <strong>Dezabonare:</strong> Utilizatorii se pot dezabona prin link-ul din email</li>
            <li>• <strong>Performanță:</strong> Sistem optimizat pentru {{ $dailyLimit }} emailuri/zi cu pauze între
                trimiteri</li>
        </ul>
    </div>

    {{-- Footer cu ultima actualizare --}}
    <div class="text-xs text-center text-gray-500 dark:text-gray-400">
        Ultima actualizare: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</div>
