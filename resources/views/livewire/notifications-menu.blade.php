<div class="relative" x-data="{ open: false }">
    <button @click="open = !open"
        class="relative flex items-center justify-center p-2 text-gray-300 transition duration-300 rounded-full hover:text-blue-400 hover:bg-gray-800 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        @if ($this->unreadCount > 0)
            <span
                class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-blue-600 rounded-full">
                {{ $this->unreadCount }}
            </span>
        @endif
    </button>

    <!-- Dropdown panel, show/hide based on dropdown state -->
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" @click.away="open = false"
        class="fixed inset-x-0 z-50 w-full bg-gray-800 border border-gray-700 shadow-lg top-16 md:absolute md:inset-auto md:w-80 md:mt-2 md:right-0 md:rounded-md md:origin-top-right">
        <div class="flex flex-col h-[calc(100vh-4rem)] md:h-full p-3">
            <div class="flex items-center justify-between pb-2 mb-4 border-b border-gray-700">
                <h3 class="text-lg font-semibold text-white">Notificări</h3>
                <div class="flex items-center space-x-3">
                    @if ($this->unreadCount > 0)
                        <button wire:click="markAllAsRead" class="text-sm text-blue-400 hover:text-blue-300">
                            Marchează toate ca citite
                        </button>
                    @endif
                    <button @click="open = false" class="text-gray-400 md:hidden hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex-grow overflow-y-auto divide-y divide-gray-700">
                @forelse($this->notifications as $notification)
                    <div wire:key="notification-{{ $notification->id }}"
                        class="py-3 {{ $notification->read_at ? 'opacity-70' : '' }}">
                        <a href="{{ $notification->link }}" wire:click="markAsRead({{ $notification->id }})"
                            class="block p-3 transition duration-150 rounded-md hover:bg-gray-700">
                            <div class="flex items-center mb-2">
                                <span
                                    class="w-2 h-2 {{ $notification->read_at ? 'bg-gray-600' : 'bg-blue-500' }} rounded-full"></span>
                                <div class="ml-2 font-medium text-white">{{ $notification->title }}</div>
                            </div>
                            @if ($notification->body)
                                <div class="pl-4 mt-1 mb-2 text-sm text-gray-300">
                                    {{ \Illuminate\Support\Str::limit($notification->body, 150) }}</div>
                            @endif
                            <div class="flex justify-end">
                                <span
                                    class="inline-flex items-center text-xs text-gray-400 bg-gray-700 px-2 py-0.5 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-10 text-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-2 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Nu ai notificări.
                    </div>
                @endforelse
            </div>

            @if (count($this->notifications) > 0)
                <div class="pt-2 mt-3 text-center border-t border-gray-700">
                    <a href="{{ route('notifications') }}"
                        class="inline-block px-4 py-2 text-sm text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                        Vezi toate notificările
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
