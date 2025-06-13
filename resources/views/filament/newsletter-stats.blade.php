@php
    use App\Models\Newsletter;
    use Carbon\Carbon;

    // Statistici generale
    $totalSubscribers = Newsletter::count();
    $pendingCount = Newsletter::pending()->count();
    $sentCount = Newsletter::sent()->count();
    $failedCount = Newsletter::failed()->count();

    // Statistici zilnice
    $sentToday = Newsletter::getSentTodayCount();
    $remainingQuota = Newsletter::getRemainingQuota(200);
    $dailyLimit = 200;

    // Statistici săptămânale
    $sentThisWeek = Newsletter::whereDate('sent_at', '>=', Carbon::now()->startOfWeek())
        ->where('status', Newsletter::STATUS_SENT)
        ->count();

    // Statistici lunare
    $sentThisMonth = Newsletter::whereDate('sent_at', '>=', Carbon::now()->startOfMonth())
        ->where('status', Newsletter::STATUS_SENT)
        ->count();

    // Rata de succes
    $successRate = $sentCount > 0 ? round(($sentCount / ($sentCount + $failedCount)) * 100, 1) : 0;

    // Ultimele 7 zile - pentru grafic simplu
    $last7Days = collect();
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i);
        $count = Newsletter::whereDate('sent_at', $date)->where('status', Newsletter::STATUS_SENT)->count();
        $last7Days->push([
            'date' => $date->format('d/m'),
            'count' => $count,
        ]);
    }

    $maxDaily = $last7Days->max('count') ?: 1;
@endphp

<div class="p-6 space-y-6">
    {{-- Header --}}
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            📊 Statistici Newsletter
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Monitorizarea performanței sistemului de newsletter
        </p>
    </div>

    {{-- Statistici principale --}}
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        <div class="p-4 text-center rounded-lg bg-blue-50 dark:bg-blue-900/20">
            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                {{ number_format($totalSubscribers) }}
            </div>
            <div class="text-sm text-blue-800 dark:text-blue-300">
                Total abonați
            </div>
        </div>

        <div class="p-4 text-center rounded-lg bg-yellow-50 dark:bg-yellow-900/20">
            <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                {{ number_format($pendingCount) }}
            </div>
            <div class="text-sm text-yellow-800 dark:text-yellow-300">
                În așteptare
            </div>
        </div>

        <div class="p-4 text-center rounded-lg bg-green-50 dark:bg-green-900/20">
            <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                {{ number_format($sentCount) }}
            </div>
            <div class="text-sm text-green-800 dark:text-green-300">
                Trimise cu succes
            </div>
        </div>

        <div class="p-4 text-center rounded-lg bg-red-50 dark:bg-red-900/20">
            <div class="text-2xl font-bold text-red-600 dark:text-red-400">
                {{ number_format($failedCount) }}
            </div>
            <div class="text-sm text-red-800 dark:text-red-300">
                Eșuate
            </div>
        </div>
    </div>

    {{-- Limita zilnică --}}
    <div class="p-6 rounded-lg bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            📅 Limita zilnică
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
        @endif
    </div>

    {{-- Statistici periodice --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <h4 class="font-medium text-gray-900 dark:text-white">Săptămâna aceasta</h4>
            <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($sentThisWeek) }}</p>
            <p class="text-xs text-gray-500">emailuri trimise</p>
        </div>

        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <h4 class="font-medium text-gray-900 dark:text-white">Luna aceasta</h4>
            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($sentThisMonth) }}
            </p>
            <p class="text-xs text-gray-500">emailuri trimise</p>
        </div>

        <div class="p-4 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <h4 class="font-medium text-gray-900 dark:text-white">Rata de succes</h4>
            <p
                class="text-2xl font-bold {{ $successRate >= 95 ? 'text-green-600' : ($successRate >= 85 ? 'text-yellow-600' : 'text-red-600') }}">
                {{ $successRate }}%
            </p>
            <p class="text-xs text-gray-500">din total încercări</p>
        </div>
    </div>

    {{-- Grafic ultimele 7 zile --}}
    <div class="p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">
            📈 Ultimele 7 zile
        </h3>

        <div class="flex items-end justify-between h-32 space-x-2">
            @foreach ($last7Days as $day)
                <div class="flex flex-col items-center flex-1">
                    <div class="flex items-end justify-center w-full transition-all duration-300 rounded-t bg-gradient-to-t from-blue-500 to-blue-300"
                        style="height: {{ $day['count'] > 0 ? max(($day['count'] / $maxDaily) * 100, 8) : 4 }}%">
                        @if ($day['count'] > 0)
                            <span class="mb-1 text-xs font-medium text-white">{{ $day['count'] }}</span>
                        @endif
                    </div>
                    <div class="mt-2 text-xs text-gray-600 dark:text-gray-400">{{ $day['date'] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Informații utile --}}
    <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
        <h4 class="mb-2 font-medium text-blue-900 dark:text-blue-100">💡 Informații utile</h4>
        <ul class="space-y-1 text-sm text-blue-800 dark:text-blue-200">
            <li>• Limita zilnică este setată la {{ $dailyLimit }} emailuri pentru a respecta restricțiile
                hosting-ului</li>
            <li>• Emailurile se trimit cu o pauză de 2 secunde între ele pentru a evita blocarea SMTP</li>
            <li>• Job-urile rămase se reprogramează automat pentru ziua următoare la ora 09:00</li>
            <li>• Sistemul salvează automat erorile pentru debugging în cazul problemelor</li>
        </ul>
    </div>

    {{-- Footer cu ultima actualizare --}}
    <div class="text-xs text-center text-gray-500 dark:text-gray-400">
        Ultima actualizare: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</div>
