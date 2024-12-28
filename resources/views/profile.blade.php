<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <!-- Profile Header with Avatar -->
            <div class="p-4 bg-gray-700 shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center space-x-8">
                        <div class="relative group">
                            <div class="relative">
                                <!-- Imagine -->
                                <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                                    class="object-cover w-32 h-32 rounded-full shadow-lg">
                                <!-- Loading indicator -->
                                <div class="absolute inset-0 flex items-center justify-center hidden bg-black bg-opacity-50 rounded-full"
                                    id="avatar-loading">
                                    <svg class="w-8 h-8 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Upload form -->
                            <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data"
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                @csrf
                                @method('PATCH')
                                <label for="avatar-upload"
                                    class="p-2 text-sm text-white bg-black bg-opacity-50 rounded-full cursor-pointer hover:bg-opacity-70">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                                <input id="avatar-upload" type="file" name="avatar" class="hidden" accept="image/*"
                                    onchange="if(this.files[0]) { document.getElementById('avatar-loading').classList.remove('hidden'); this.form.submit(); }">
                            </form>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                            <p class="text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="p-4 bg-gray-700 shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <!-- Password Update -->
            <div class="p-4 bg-gray-700 shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <!-- Subscription Status -->
            <div class="p-4 bg-gray-700 shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @auth
                        @if (auth()->user()->subscribed('prod_QGao8eve2XHvzf'))
                            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                                <p class="font-medium">Abonament Activ</p>
                                <p class="mt-1">Pentru întrebări sau nelămuriri: contact@clickmusic.ro</p>
                            </div>
                        @else
                            <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg">
                                <p class="font-medium">Fără Abonament Activ</p>
                                <p class="mt-1">Activează un abonament pentru a accesa toate funcționalitățile.</p>
                            </div>
                        @endif
                    @endauth

                    <div class="flex items-center gap-4">
                        <a href="/abonament"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Vezi Abonamente
                        </a>

                        @if (auth()->user()->subscribed('prod_QGao8eve2XHvzf'))
                            <form action="{{ route('subscription.cancel') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                    onclick="return confirm('Ești sigur că vrei să anulezi abonamentul?')">
                                    Anulează Abonamentul
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-4 bg-gray-700 shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>

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
