<x-app-layout>
    <div class="min-h-screen py-12 bg-black">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Gradient Background Effect -->
            <div class="relative">
                <div class="absolute inset-0 blur-3xl opacity-30">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
                </div>

                <!-- Profile Content -->
                <div class="relative space-y-6">
                    <!-- Profile Header with Avatar -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-gradient-xy">
                        </div>

                        <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                            <div class="flex flex-col items-center space-y-4 sm:flex-row sm:space-x-8 sm:space-y-0">
                                <!-- Avatar Section -->
                                <div class="relative group/avatar" id="avatarContainer">
                                    <div class="flex flex-col items-center space-y-2">
                                        <div class="relative flex items-center justify-center cursor-pointer"
                                            onclick="document.getElementById('avatar-upload').click();">
                                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                                                class="object-cover w-24 h-24 overflow-hidden transition-all duration-300 rounded-full sm:w-32 sm:h-32 aspect-square ring-2 ring-blue-400/50 touch-manipulation hover:brightness-90">

                                            <!-- Hint overlay (always visible, enhanced on hover) -->
                                            <div
                                                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 rounded-full bg-blue-500/30 hover:bg-blue-500/50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>

                                            <!-- Loading indicator -->
                                            <div class="absolute inset-0 items-center justify-center hidden bg-black bg-opacity-50 rounded-full"
                                                id="avatar-loading">
                                                <svg class="w-8 h-8 text-white animate-spin"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Always visible button/text that directly triggers file upload -->
                                        <label for="avatar-upload"
                                            class="px-3 py-1 text-xs font-medium text-gray-300 transition-all duration-300 border border-gray-700 rounded-md cursor-pointer hover:text-white hover:border-blue-500 hover:bg-gray-800/50 active:scale-95">
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                                Schimbă imaginea
                                            </span>
                                        </label>
                                    </div>

                                    <!-- Upload form (simplified to just contain the input) -->
                                    <form action="{{ route('profile.avatar') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <input id="avatar-upload" type="file" name="avatar" class="hidden"
                                            accept="image/*"
                                            onchange="if(this.files[0]) { 
                                                document.getElementById('avatar-loading').classList.remove('hidden'); 
                                                document.getElementById('avatar-loading').classList.add('flex'); 
                                                this.form.submit(); 
                                            }">
                                    </form>
                                </div>

                                <div class="text-center sm:text-left">
                                    <h3
                                        class="text-2xl font-bold tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">
                                        {{ auth()->user()->name }}
                                    </h3>
                                    <p class="mt-1 text-gray-400">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Information -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-gradient-xy">
                        </div>
                        <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                            <livewire:profile.update-profile-information-form />
                        </div>
                    </div>

                    <!-- Password Update -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-gradient-xy">
                        </div>
                        <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                            <livewire:profile.update-password-form />
                        </div>
                    </div>

                    <!-- Subscription Status -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-gradient-xy">
                        </div>
                        <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                            @auth
                                @if (auth()->user()->subscribed('prod_QGao8eve2XHvzf'))
                                    <div class="p-4 mb-6 border rounded-lg border-green-500/20 bg-green-500/10">
                                        <p class="font-medium text-green-400">Abonament Activ</p>
                                        <p class="mt-1 text-gray-300">Pentru întrebări sau nelămuriri: contact@clickmusic.ro
                                        </p>
                                    </div>
                                @else
                                    <div class="p-4 mb-6 border rounded-lg border-yellow-500/20 bg-yellow-500/10">
                                        <p class="font-medium text-yellow-400">Fără Abonament Activ</p>
                                        <p class="mt-1 text-gray-300">Activează un abonament pentru a accesa toate
                                            funcționalitățile.</p>
                                    </div>
                                @endif
                            @endauth

                            <div class="flex items-center gap-4">
                                <a href="/abonament"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                                    Vezi Abonamente
                                </a>

                                @if (auth()->user()->subscribed('prod_QGao8eve2XHvzf'))
                                    <form action="{{ route('subscription.cancel') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900"
                                            onclick="return confirm('Ești sigur că vrei să anulezi abonamentul?')">
                                            Anulează Abonamentul
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-gradient-xy">
                        </div>
                        <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                            <livewire:profile.delete-user-form />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    @if (session('status') === 'avatar-updated')
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="fixed px-4 py-2 text-white bg-green-500 rounded-lg shadow-lg bottom-4 right-4">
            Avatar actualizat cu succes!
        </div>
    @endif

    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="fixed px-4 py-2 text-white bg-red-500 rounded-lg shadow-lg bottom-4 right-4">
            {{ $errors->first() }}
        </div>
    @endif

</x-app-layout>
