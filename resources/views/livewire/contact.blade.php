<div>
    <div class="relative min-h-screen py-16">
        <!-- Gradient ambient în fundal -->
        <div class="absolute inset-0 blur-3xl opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-blue-600 via-cyan-500 to-black"></div>
        </div>

        <!-- Container principal -->
        <div class="container relative px-4 mx-auto">
            <!-- Card principal -->
            <div
                class="relative p-[0.5px] bg-gradient-to-br from-blue-500/20 via-cyan-400/20 to-emerald-400/20 rounded-xl max-w-4xl mx-auto mt-24">
                <div class="p-8 text-white glass-card">
                    <!-- Header -->
                    <div class="mb-8">
                        <h1
                            class="text-3xl md:text-4xl font-bold tracking-[0.2em] text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600 uppercase font-roboto-condensed">
                            Contact
                        </h1>
                        <div class="w-24 h-1 mt-2 rounded-full bg-gradient-to-r from-blue-500 to-transparent"></div>
                    </div>

                    <!-- Mesaj de succes -->
                    @if ($successMessage)
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            class="p-4 mb-6 text-green-300 border rounded-lg border-green-500/50 bg-green-500/10 backdrop-blur-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $successMessage }}
                            </div>
                        </div>
                    @endif

                    <!-- Erori generale -->
                    @error('form')
                        <div
                            class="p-4 mb-6 text-red-300 border rounded-lg border-red-500/50 bg-red-500/10 backdrop-blur-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        </div>
                    @enderror

                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                        <!-- Formularul de contact -->
                        <div>
                            <h2 class="mb-6 text-xl font-semibold text-blue-400">Trimite-ne un mesaj</h2>

                            <form wire:submit.prevent="submitForm" class="space-y-6">
                                <!-- Numele -->
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-300">
                                        Numele tău *
                                    </label>
                                    <input type="text" id="name" wire:model="name"
                                        class="block w-full px-4 py-3 text-white transition duration-300 ease-in-out bg-gray-800/50 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700/50 @error('name') border-red-500 @enderror"
                                        placeholder="Introdu numele tău">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-300">
                                        Adresa de email *
                                    </label>
                                    <input type="email" id="email" wire:model="email"
                                        class="block w-full px-4 py-3 text-white transition duration-300 ease-in-out bg-gray-800/50 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700/50 @error('email') border-red-500 @enderror"
                                        placeholder="exemplu@email.ro">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Subiectul -->
                                <div>
                                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-300">
                                        Subiectul *
                                    </label>
                                    <input type="text" id="subject" wire:model="subject"
                                        class="block w-full px-4 py-3 text-white transition duration-300 ease-in-out bg-gray-800/50 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700/50 @error('subject') border-red-500 @enderror"
                                        placeholder="Despre ce vrei să vorbești?">
                                    @error('subject')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Mesajul -->
                                <div>
                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-300">
                                        Mesajul tău *
                                    </label>
                                    <textarea id="message" wire:model="message" rows="5"
                                        class="block w-full px-4 py-3 text-white transition duration-300 ease-in-out bg-gray-800/50 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-700/50 @error('message') border-red-500 @enderror"
                                        placeholder="Scrie mesajul tău aici..."></textarea>
                                    @error('message')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Butonul de trimitere -->
                                <div>
                                    <button type="submit" wire:loading.attr="disabled"
                                        class="w-full px-6 py-3 text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-500/50 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span wire:loading.remove>Trimite mesajul</span>
                                        <span wire:loading class="flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                </path>
                                            </svg>
                                            Se trimite...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Informații de contact -->
                        <div class="space-y-6">
                            <h2 class="mb-6 text-xl font-semibold text-blue-400">Informații de contact</h2>

                            <p class="text-lg leading-relaxed text-gray-300">
                                Pentru orice nelămuriri, sugestii sau reclamații, suntem aici să vă ajutăm:
                            </p>

                            <!-- Email -->
                            <div class="p-6 border rounded-lg bg-white/5 backdrop-blur-sm border-white/10">
                                <div class="flex items-center mb-4 text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-lg font-semibold">Email</span>
                                </div>
                                <a href="mailto:contact@clickmusic.ro"
                                    class="text-blue-400 transition-colors duration-300 hover:text-blue-300">
                                    contact@clickmusic.ro
                                </a>
                            </div>

                            <!-- Timp de răspuns -->
                            <div class="p-6 border rounded-lg bg-white/5 backdrop-blur-sm border-white/10">
                                <div class="flex items-center mb-4 text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-lg font-semibold">Timp de răspuns</span>
                                </div>
                                <p class="text-gray-300">În maxim 24 de ore în zilele lucrătoare</p>
                            </div>

                            <!-- Secțiune servicii -->
                            <div class="p-6 border rounded-lg bg-white/5 backdrop-blur-sm border-white/10">
                                <h3 class="mb-4 text-lg font-semibold text-blue-400">Vă încurajăm să ne contactați
                                    pentru:</h3>
                                <ul class="space-y-3 list-none">
                                    <li class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Întrebări despre abonamente
                                    </li>
                                    <li class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Asistență tehnică
                                    </li>
                                    <li class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Sugestii pentru îmbunătățirea platformei
                                    </li>
                                    <li class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Feedback despre experiența dumneavoastră
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center">
                                <p class="text-lg text-gray-300">
                                    Așteptăm cu interes să auzim de la voi!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
