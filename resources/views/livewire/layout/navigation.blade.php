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
                <livewire:megaphone />
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
                            <x-dropdown-link :href="route('profile')" wire:navigate
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
        class="fixed inset-0 z-40 flex flex-col items-center justify-center w-full h-screen bg-gray-900 sm:hidden bg-opacity-95"
        style="display: none;">

        <div class="w-full px-4 mx-auto max-w-7xl">
            <!-- User Info at Top -->
            <div class="flex items-center mb-8">
                <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                    class="w-12 h-12 mr-4 border-2 border-blue-400 rounded-full">
                <div>
                    <div class="text-xl font-medium text-white" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="text-sm font-medium text-gray-400">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex flex-col items-center space-y-6 uppercase">
                <x-responsive-nav-link :href="route('videoclipuri')" :active="request()->routeIs('videoclipuri')" wire:navigate
                    class="w-full py-2 text-2xl font-medium text-center text-white hover:text-blue-400">
                    {{ __('Media') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('forum.index')" :active="request()->routeIs('forum.index')" wire:navigate
                    class="w-full py-2 text-2xl font-medium text-center text-white hover:text-blue-400">
                    {{ __('Comunitate') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.index')" wire:navigate
                    class="w-full py-2 text-2xl font-medium text-center text-white hover:text-blue-400">
                    {{ __('Blog') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('magazin')" :active="request()->routeIs('magazin')" wire:navigate
                    class="w-full py-2 text-2xl font-medium text-center text-white hover:text-blue-400">
                    {{ __('Magazin') }}
                </x-responsive-nav-link>

                <!-- User Profile & Logout -->
                <div class="w-full pt-6 mt-6 border-t border-gray-700">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate
                        class="w-full py-2 text-2xl font-medium text-center text-white hover:text-blue-400">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <button wire:click="logout" class="w-full py-2 text-center">
                        <x-responsive-nav-link
                            class="w-full text-2xl font-medium text-center text-white hover:text-blue-400">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </nav>
        </div>
    </div>
</nav>
