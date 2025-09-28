@php
    use App\Models\Newsletter;
    use App\Models\User;
    use Carbon\Carbon;

    // Statistici abonați newsletter
    $totalSubscribers = Newsletter::subscribers()->count();
    $pendingSubscribers = Newsletter::pending()->count();
    $failedSubscribers = Newsletter::failed()->count();

    // Statistici pe ultimele 30 de zile
    $newThisMonth = Newsletter::subscribers()
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->count();

    // Utilizatori vs Newsletter subscribers
    $usersSubscribed = User::getNewsletterSubscribersCount();
    $duplicates = User::whereIn('email', Newsletter::pending()->pluck('recipient_email'))->count();

    // Growth rate
    $lastMonthCount = Newsletter::subscribers()
        ->where('created_at', '<', Carbon::now()->subDays(30))
        ->count();
    $growthRate = $lastMonthCount > 0 ? round((($totalSubscribers - $lastMonthCount) / $lastMonthCount) * 100, 1) : 0;
@endphp

<div class="p-6 space-y-6">
    {{-- Header --}}
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            📊 Statistici Abonați Newsletter
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Analiza completă a listei de abonați
        </p>
    </div>

    {{-- Statistici principale --}}
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        <div class="p-4 text-center bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                {{ number_format($totalSubscribers) }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Total în Listă
            </div>
        </div>

        <div class="p-4 text-center bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                {{ number_format($pendingSubscribers) }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Abonați Activi
            </div>
        </div>

        <div class="p-4 text-center bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="text-2xl font-bold text-red-600 dark:text-red-400">
                {{ number_format($failedSubscribers) }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Dezabonați
            </div>
        </div>

        <div class="p-4 text-center bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                {{ number_format($newThisMonth) }}
            </div>
            <div class="text-sm text-gray-600 dark:text-gray-400">
                Noi (30 zile)
            </div>
        </div>
    </div>

    {{-- Rata de conversie --}}
    <div class="p-6 rounded-lg bg-gradient-to-r from-green-50 to-blue-50 dark:from-green-900/20 dark:to-blue-900/20">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            📈 Performanță
        </h3>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600 dark:text-green-400">
                    {{ $totalSubscribers > 0 ? round(($pendingSubscribers / $totalSubscribers) * 100, 1) : 0 }}%
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Rată Abonare
                </div>
            </div>

            <div class="text-center">
                <div class="text-3xl font-bold {{ $growthRate >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    {{ $growthRate > 0 ? '+' : '' }}{{ $growthRate }}%
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Creștere (30 zile)
                </div>
            </div>

            <div class="text-center">
                <div class="text-3xl font-bold text-orange-600 dark:text-orange-400">
                    {{ number_format($duplicates) }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Duplicate cu Utilizatori
                </div>
            </div>
        </div>
    </div>

    {{-- Comparație cu utilizatori app --}}
    <div class="p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            👥 Newsletter vs Utilizatori App
        </h3>

        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Listă Newsletter:</span>
                <span class="font-semibold">{{ number_format($pendingSubscribers) }} abonați</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Utilizatori App:</span>
                <span class="font-semibold">{{ number_format($usersSubscribed) }} abonați</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Duplicate:</span>
                <span class="font-semibold text-orange-600">{{ number_format($duplicates) }}</span>
            </div>
            <hr class="border-gray-200 dark:border-gray-700">
            <div class="flex justify-between">
                <span class="font-medium text-gray-900 dark:text-white">Total Unic:</span>
                <span class="font-bold text-green-600">{{ number_format($pendingSubscribers + $usersSubscribed - $duplicates) }}</span>
            </div>
        </div>
    </div>

    {{-- Activitate recentă --}}
    <div class="p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            🕐 Activitate Recentă
        </h3>

        @php
            $recentActivity = Newsletter::subscribers()
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        @endphp

        <div class="space-y-3">
            @forelse($recentActivity as $subscriber)
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">
                            {{ $subscriber->recipient_name }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $subscriber->recipient_email }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-900 dark:text-white">
                            {{ $subscriber->created_at->format('d/m/Y') }}
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $subscriber->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">Nu există activitate recentă.</p>
            @endforelse
        </div>
    </div>

    {{-- Informații utile --}}
    <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
        <h4 class="mb-2 font-medium text-blue-900 dark:text-blue-100">💡 Informații</h4>
        <ul class="space-y-1 text-sm text-blue-800 dark:text-blue-200">
            <li>• <strong>Lista Newsletter:</strong> Adrese adăugate manual prin formulare</li>
            <li>• <strong>Status Abonat:</strong> Poate primi newslettere</li>
            <li>• <strong>Status Dezabonat:</strong> A fost eliminat din lista de trimitere</li>
            <li>• <strong>Import/Export:</strong> Folosește butoanele de mai sus pentru gestionare CSV</li>
        </ul>
    </div>

    {{-- Footer cu ultima actualizare --}}
    <div class="text-xs text-center text-gray-500 dark:text-gray-400">
        Ultima actualizare: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</div>