<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-800">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('videoclipuri') }}" wire:navigate>
                        <x-application-logo class="block w-auto text-blue-400 fill-current h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('videoclipuri')" :active="request()->routeIs('videoclipuri')" wire:navigate
                        class="text-gray-300 transition-colors duration-300 hover:text-blue-400">
                        {{ __('Media') }}
                    </x-nav-link>
                    <x-nav-link :href="route('forum.index')" :active="request()->routeIs('forum.index')" wire:navigate
                        class="text-gray-300 transition-colors duration-300 hover:text-blue-400">
                        {{ __('Comunitate') }}
                    </x-nav-link>
                    <x-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.index')" wire:navigate
                        class="text-gray-300 transition-colors duration-300 hover:text-blue-400">
                        {{ __('Blog') }}
                    </x-nav-link>
                    <x-nav-link :href="route('magazin')" :active="request()->routeIs('magazin')" wire:navigate
                        class="text-gray-300 transition-colors duration-300 hover:text-blue-400">
                        {{ __('Magazin') }}
                    </x-nav-link>

                </div>
            </div>

            <div class="flex items-center justify-center ml-auto">
                <livewire:notifications-menu />
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-300 transition duration-300 ease-in-out hover:text-blue-400 hover:border-blue-400 focus:outline-none">
                            <!-- Avatar -->
                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                                class="w-8 h-8 mr-2 rounded-full">

                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>
                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-gray-800 border border-gray-700 rounded-md">
                            <x-dropdown-link :href="route('profile.edit')" wire:navigate
                                class="text-white hover:bg-gray-700 hover:text-blue-400">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link class="text-white hover:bg-gray-700 hover:text-blue-400">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="relative z-50 flex items-center justify-center p-2 text-gray-400 transition duration-300 rounded-md hover:text-blue-400 hover:bg-gray-800 focus:outline-none">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu - Fullscreen Overlay -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 z-40 flex flex-col items-center justify-start w-full h-screen overflow-y-auto bg-gradient-to-b from-gray-900 to-gray-800 sm:hidden"
        style="display: none;">

        <div class="w-full px-4 pt-16 mx-auto max-w-7xl">
            <!-- User Info at Top - Enhanced Design -->
            <div class="flex flex-col items-center mb-10">
                <div class="relative mb-3">
                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                        class="w-20 h-20 border-2 border-blue-400 rounded-full shadow-lg">
                    <div
                        class="absolute bottom-0 right-0 flex items-center justify-center w-6 h-6 bg-green-500 border-2 border-gray-900 rounded-full">
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-white" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="text-sm font-medium text-blue-400">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <!-- Navigation Links - Enhanced Design -->
            <nav class="flex flex-col items-center space-y-5">
                <x-responsive-nav-link :href="route('videoclipuri')" :active="request()->routeIs('videoclipuri')" wire:navigate
                    class="w-full py-3 text-xl font-bold tracking-wider text-center text-gray-100 uppercase transition-all duration-300 ease-in-out transform hover:text-blue-400 hover:scale-105">
                    <span class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 4v16M17 4v16M3 8h18M3 16h18" />
                        </svg>
                        {{ __('Media') }}
                    </span>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('forum.index')" :active="request()->routeIs('forum.index')" wire:navigate
                    class="w-full py-3 text-xl font-bold tracking-wider text-center text-gray-100 uppercase transition-all duration-300 ease-in-out transform hover:text-blue-400 hover:scale-105">
                    <span class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                        {{ __('Comunitate') }}
                    </span>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.index')" wire:navigate
                    class="w-full py-3 text-xl font-bold tracking-wider text-center text-gray-100 uppercase transition-all duration-300 ease-in-out transform hover:text-blue-400 hover:scale-105">
                    <span class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        {{ __('Blog') }}
                    </span>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('magazin')" :active="request()->routeIs('magazin')" wire:navigate
                    class="w-full py-3 text-xl font-bold tracking-wider text-center text-gray-100 uppercase transition-all duration-300 ease-in-out transform hover:text-blue-400 hover:scale-105">
                    <span class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        {{ __('Magazin') }}
                    </span>
                </x-responsive-nav-link>
            </nav>

            <!-- User Profile & Logout - Enhanced Design -->
            <div class="w-full px-6 pt-8 mt-10 border-t border-gray-700">
                <div class="flex flex-col space-y-4">
                    <x-responsive-nav-link :href="route('profile.edit')" wire:navigate
                        class="flex items-center justify-center w-full px-6 py-3 text-lg font-medium text-center text-gray-100 transition-colors duration-300 ease-in-out bg-gray-800 rounded-lg hover:bg-gray-700 hover:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <button wire:click="logout" class="w-full">
                        <x-responsive-nav-link
                            class="flex items-center justify-center w-full px-6 py-3 text-lg font-medium text-center text-gray-100 transition-colors duration-300 ease-in-out bg-gray-800 rounded-lg hover:bg-red-600 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>

            <!-- Footer with App Version -->
            <div class="mt-10 mb-6 text-xs text-center text-gray-500">
                <p>ClickMusic © 2025</p>
            </div>
        </div>
    </div>
</nav>
