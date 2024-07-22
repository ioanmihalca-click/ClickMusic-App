<div x-cloak x-show="open" @click.outside="open = false" class="fixed top-0 right-0 z-50 w-full h-full overflow-x-hidden transition duration-700 ease-in-out transform translate-x-0" id="notification">
    <div class="fixed top-0 left-0 z-0 w-full h-full" @click="open = false"></div>

    <div class="absolute right-0 z-30 h-screen p-8 pt-3 overflow-y-auto shadow-md 2xl:w-4/12 bg-gray-50">
        <div class="flex items-center justify-between">
            <p tabindex="0" class="text-2xl font-semibold leading-6 text-blue-500 focus:outline-none">Notificari</p>
            <button role="button" aria-label="close modal" class="rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" @click="open = false">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18" stroke="#4B5563" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 6L18 18" stroke="#4B5563" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        @if ($unread->count() > 0)
            <h2 tabindex="0" class="pt-8 pb-2 text-sm leading-normal text-gray-600 border-b border-gray-300 focus:outline-none">
                Notificari necitite
            </h2>

            @foreach ($unread as $announcement)
                <div class="w-full p-3 mt-4 bg-white rounded flex flex-shrink-0 {{ $announcement->read_at === null ? "drop-shadow shadow border" : ""  }}">
                    <x-megaphone::display :notification="$announcement"></x-megaphone::display>

                    @if($announcement->read_at === null)
                        <button role="button" aria-label="Mark as Read" class="w-6 h-6 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                x-on:click="$wire.markAsRead('{{ $announcement->id }}')"
                        >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 6L6 18" stroke="#4B5563" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 6L18 18" stroke="#4B5563" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    @endif
                </div>
            @endforeach

            @if ($announcements->count() > 0)
                <h2 tabindex="0" class="pt-8 pb-2 text-sm leading-normal text-gray-600 border-b border-gray-300 focus:outline-none">
                    Notificari precedente
                </h2>
            @endif
        @endif

        @foreach ($announcements as $announcement)
            <div class="w-full p-3 mt-4 bg-white rounded flex flex-shrink-0 {{ $announcement->read_at === null ? "drop-shadow shadow border" : ""  }}">
                <x-megaphone::display :notification="$announcement"></x-megaphone::display>
            </div>
        @endforeach

        @if ($unread->count() === 0 && $announcements->count() === 0)
            <div class="flex items-center justify-between">
                <hr class="w-full">
                <p tabindex="0" class="flex flex-shrink-0 px-3 py-16 text-sm leading-normal text-gray-500 focus:outline-none">
                    Nu exista notificari noi
                </p>
                <hr class="w-full">
            </div>
        @endif
    </div>
</div>

