@php
    // Procesăm conținutul cu variabile de test pentru preview
    $previewVariables = [
        '{{ email }}' => 'exemplu@email.com',
        '{{ name }}' => 'Utilizator Test',
    ];

    $processedContent = $campaign->getProcessedContent($previewVariables);
@endphp

<div class="space-y-6">
    {{-- Header cu informații campanie --}}
    <div class="p-6 rounded-lg bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                📧 Preview Campanie
            </h2>
            <span
                class="px-3 py-1 text-sm font-medium rounded-full {{ $campaign->status_color === 'success' ? 'bg-green-100 text-green-800' : ($campaign->status_color === 'warning' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                {{ $campaign->status_label }}
            </span>
        </div>

        <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Titlu:</span>
                <span class="text-gray-900 dark:text-white">{{ $campaign->campaign_title }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Subiect:</span>
                <span class="text-gray-900 dark:text-white">{{ $campaign->campaign_subject }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Destinatari:</span>
                <span class="text-gray-900 dark:text-white">{{ number_format($campaign->recipients_count) }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Creat:</span>
                <span class="text-gray-900 dark:text-white">{{ $campaign->created_at->format('d/m/Y H:i') }}</span>
            </div>
            @if ($campaign->scheduled_at)
                <div>
                    <span class="font-medium text-gray-700 dark:text-gray-300">Programat:</span>
                    <span
                        class="text-gray-900 dark:text-white">{{ $campaign->scheduled_at->format('d/m/Y H:i') }}</span>
                </div>
            @endif
            @if ($campaign->sent_at)
                <div>
                    <span class="font-medium text-gray-700 dark:text-gray-300">Trimis:</span>
                    <span class="text-gray-900 dark:text-white">{{ $campaign->sent_at->format('d/m/Y H:i') }}</span>
                </div>
            @endif
        </div>

        @if ($campaign->sent_count > 0 || $campaign->failed_count > 0)
            <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-6 text-sm">
                    <div class="flex items-center">
                        <span class="w-3 h-3 mr-2 bg-green-500 rounded-full"></span>
                        <span class="text-gray-700 dark:text-gray-300">Trimiși:
                            {{ number_format($campaign->sent_count) }}</span>
                    </div>
                    @if ($campaign->failed_count > 0)
                        <div class="flex items-center">
                            <span class="w-3 h-3 mr-2 bg-red-500 rounded-full"></span>
                            <span class="text-gray-700 dark:text-gray-300">Eșuați:
                                {{ number_format($campaign->failed_count) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    {{-- Informații despre variabile --}}
    <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
        <h3 class="mb-2 font-medium text-blue-900 dark:text-blue-100">💡 Variabile disponibile în conținut</h3>
        <div class="grid grid-cols-2 gap-3 text-xs text-blue-800 md:grid-cols-4 dark:text-blue-200">
            <div><code class="px-1 bg-blue-100 rounded dark:bg-blue-800">{{ site_name }}</code> =
                {{ config('app.name') }}</div>
            <div><code class="px-1 bg-blue-100 rounded dark:bg-blue-800">{{ site_url }}</code> =
                {{ config('app.url') }}</div>
            <div><code class="px-1 bg-blue-100 rounded dark:bg-blue-800">{{ year }}</code> =
                {{ date('Y') }}</div>
            <div><code class="px-1 bg-blue-100 rounded dark:bg-blue-800">{{ current_date }}</code> =
                {{ now()->format('d/m/Y') }}</div>
            <div><code class="px-1 bg-blue-100 rounded dark:bg-blue-800">{{ email }}</code> = email destinatar
            </div>
            <div><code class="px-1 bg-blue-100 rounded dark:bg-blue-800">{{ name }}</code> = nume destinatar
            </div>
        </div>
    </div>

    {{-- Preview email actual --}}
    <div class="overflow-hidden bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <div class="px-4 py-3 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <h3 class="flex items-center font-medium text-gray-900 dark:text-white">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
                Preview Email
            </h3>
        </div>

        {{-- Email header simulation --}}
        <div class="px-4 py-3 text-sm bg-gray-100 border-b border-gray-200 dark:bg-gray-600 dark:border-gray-600">
            <div class="space-y-1">
                <div><span class="font-medium">De la:</span> contact@clickmusic.ro (Click Music Ro)</div>
                <div><span class="font-medium">Către:</span> exemplu@email.com (Utilizator Test)</div>
                <div><span class="font-medium">Subiect:</span> {{ $campaign->campaign_subject }}</div>
            </div>
        </div>

        {{-- Conținutul email-ului --}}
        <div class="p-6">
            <div class="prose-sm prose max-w-none dark:prose-invert">
                {!! $processedContent !!}
            </div>
        </div>
    </div>

    {{-- Cod sursă HTML (optional, pentru debugging) --}}
    <details class="border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
        <summary
            class="p-4 font-medium text-gray-900 cursor-pointer dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
            📝 Vezi codul HTML (pentru dezvoltatori)
        </summary>
        <div class="p-4 border-t border-gray-200 dark:border-gray-600">
            <pre class="p-4 overflow-x-auto text-xs text-green-400 bg-gray-900 rounded"><code>{{ htmlspecialchars($processedContent) }}</code></pre>
        </div>
    </details>

    {{-- Acțiuni rapide --}}
    @if ($campaign->canBeSent())
        <div class="p-4 border border-yellow-200 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 dark:border-yellow-800">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-medium text-yellow-900 dark:text-yellow-100">🚀 Gata de trimitere</h3>
                    <p class="mt-1 text-sm text-yellow-800 dark:text-yellow-200">
                        Campania este gata să fie trimisă către {{ number_format($campaign->recipients_count) }}
                        destinatari.
                    </p>
                </div>
                <div class="text-sm text-right text-yellow-700 dark:text-yellow-300">
                    <div>Quota zilnică rămasă:</div>
                    <div class="font-bold">{{ \App\Models\Newsletter::getRemainingQuota(200) }}/200</div>
                </div>
            </div>
        </div>
    @endif

    {{-- Notă finală --}}
    <div class="text-xs text-center text-gray-500 dark:text-gray-400">
        Preview generat la {{ now()->format('d/m/Y H:i:s') }}
    </div>
</div>
