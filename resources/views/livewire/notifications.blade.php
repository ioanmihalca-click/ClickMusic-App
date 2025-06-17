<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-white">Notificări</h1>

                @if ($notifications->where('read_at', null)->count() > 0)
                    <button wire:click="markAllAsRead"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Marchează toate ca citite
                    </button>
                @endif
            </div>

            <div class="divide-y divide-gray-700">
                @forelse($notifications as $notification)
                    <div wire:key="notification-{{ $notification->id }}"
                        class="py-4 {{ $notification->read_at ? 'opacity-70' : '' }}">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center">
                                <span
                                    class="w-2 h-2 mr-2 {{ $notification->read_at ? 'bg-gray-600' : 'bg-blue-500' }} rounded-full"></span>
                                <span
                                    class="font-medium text-gray-200">{{ $notification->created_at->format('d.m.Y H:i') }}</span>
                            </span>
                            <span class="text-xs text-gray-400">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="p-3 mt-2 rounded-md hover:bg-gray-700">
                            <div class="font-medium text-white">{{ $notification->title }}</div>
                            @if ($notification->body)
                                <div class="mt-2 text-sm text-gray-300">
                                    {{ $notification->body }}
                                </div>
                            @endif
                            @if ($notification->link)
                                <div class="mt-3">
                                    <a href="{{ $notification->link }}" wire:click="markAsRead({{ $notification->id }})"
                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-400 bg-gray-700 rounded-md hover:bg-gray-600">
                                        Vezi detalii
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-gray-400">
                        Nu ai notificări.
                    </div>
                @endforelse
            </div>

            @if ($notifications->hasPages())
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
