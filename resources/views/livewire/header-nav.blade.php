<header x-data="{ isOpen: false }" class="fixed top-0 left-0 z-50 w-full bg-gradient-to-b from-black to-transparent">
    <div class="container flex items-center justify-between px-4 py-2 mx-auto">
        <a href="/" class="flex items-center">
            <img src="/img/logo alb.png" alt="Logo Click Music" class="w-auto h-12">
        </a>

        <!-- Desktop menu -->
        <nav class="hidden md:flex md:space-x-8">
            <a href="/" wire:navigate
                class="text-base font-medium text-white hover:text-blue-300 font-roboto">Acasă</a>

            <a href="/magazin" wire:navigate
                class="text-base font-medium text-white hover:text-blue-300 font-roboto">Magazin</a>
            <a href="/blog" wire:navigate
                class="text-base font-medium text-white hover:text-blue-300 font-roboto">Blog</a>
            <a href="/accespremium" wire:navigate
                class="text-base font-medium text-white hover:text-blue-300 font-roboto">Acces
                Premium</a>
            <a href="/contact" wire:navigate
                class="text-base font-medium text-white hover:text-blue-300 font-roboto">Contact</a>
            <a href="https://www.youtube.com/clickmusicromania"
                class="text-base font-medium text-white hover:text-blue-300 font-roboto">Youtube</a>

        </nav>

        <!-- Mobile menu button -->
        <button @click="isOpen = !isOpen"
            class="relative z-50 flex items-center space-x-2 md:hidden focus:outline-none">
            <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"
                    :class="{ 'hidden': isOpen, 'inline-flex': !isOpen }"></line>
                <line x1="3" y1="6" x2="21" y2="6"
                    :class="{ 'hidden': isOpen, 'inline-flex': !isOpen }"></line>
                <line x1="3" y1="18" x2="21" y2="18"
                    :class="{ 'hidden': isOpen, 'inline-flex': !isOpen }"></line>
                <line x1="18" y1="6" x2="6" y2="18"
                    :class="{ 'hidden': !isOpen, 'inline-flex': isOpen }"></line>
                <line x1="6" y1="6" x2="18" y2="18"
                    :class="{ 'hidden': !isOpen, 'inline-flex': isOpen }"></line>
            </svg>
        </button>

        <!-- Mobile menu dropdown -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="absolute inset-0 z-40 flex items-center justify-center w-full h-screen bg-black bg-opacity-90 md:hidden"
            style="display: none;">
            <nav class="flex flex-col items-center space-y-8">
                <a href="/" wire:navigate
                    class="text-2xl font-medium text-white hover:text-blue-300 font-roboto">Acasă</a>
                <a href="/magazin" wire:navigate
                    class="text-2xl font-medium text-white hover:text-blue-300 font-roboto">Magazin</a>
                <a href="/blog" wire:navigate
                    class="text-2xl font-medium text-white hover:text-blue-300 font-roboto">Blog</a>
                <a href="/accespremium" wire:navigate
                    class="text-2xl font-medium text-white hover:text-blue-300 font-roboto">Acces
                    Premium</a>
                <a href="/contact" wire:navigate
                    class="text-2xl font-medium text-white hover:text-blue-300 font-roboto">Contact</a>
                <a href="https://www.youtube.com/clickmusicromania"
                    class="text-2xl font-medium text-white hover:text-blue-300 font-roboto">Youtube</a>

            </nav>
        </div>
    </div>
</header>
