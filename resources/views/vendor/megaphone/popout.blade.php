<div x-cloak x-show="open" @click.outside="open = false" class="fixed inset-0 z-50 overflow-hidden" id="notification">
    <div class="absolute inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="open = false"></div>

    <div class="fixed inset-y-0 right-0 flex max-w-full">
        <div class="w-screen max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-3xl xl:max-w-4xl">
            <div class="flex flex-col h-full overflow-y-scroll bg-white shadow-xl">
                <div class="sticky top-0 z-10 px-4 py-6 bg-white border-b border-gray-200 sm:px-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-blue-700">Notificări</h2>
                        <button @click="open = false" class="text-gray-400 rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <span class="sr-only">Închide panoul</span>
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto">
                    @if ($unread->count() > 0)
                        <div class="px-4 py-2 sm:px-6">
                            <h3 class="text-xs font-semibold tracking-wider text-gray-500 uppercase">Notificări necitite</h3>
                        </div>

                        @foreach ($unread as $announcement)
                            <div class="px-4 py-2 sm:px-6">
                                <div class="flex items-center justify-between p-3 transition duration-150 ease-in-out border-l-4 border-blue-600 rounded-lg shadow-sm bg-blue-50 hover:bg-blue-100">
                                    <x-megaphone::display :notification="$announcement"></x-megaphone::display>
                                    @if($announcement->read_at === null)
                                        <button x-on:click="$wire.markAsRead('{{ $announcement->id }}')"
                                                class="flex-shrink-0 p-1 ml-2 text-blue-600 rounded-full hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <span class="sr-only">Marchează ca citită</span>
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @if ($announcements->count() > 0)
                            <div class="px-4 py-2 mt-4 sm:px-6">
                                <h3 class="text-xs font-semibold tracking-wider text-gray-500 uppercase">Notificări precedente</h3>
                            </div>
                        @endif
                    @endif

                    @foreach ($announcements as $announcement)
                        <div class="px-4 py-2 sm:px-6">
                            <div class="flex items-center justify-between p-3 transition duration-150 ease-in-out bg-white border-l-4 border-gray-200 rounded-lg shadow-sm hover:bg-gray-50">
                                <x-megaphone::display :notification="$announcement"></x-megaphone::display>
                            </div>
                        </div>
                    @endforeach

                    @if ($unread->count() === 0 && $announcements->count() === 0)
                        <div class="px-4 py-16 text-center sm:px-6">
                            <p class="text-sm text-gray-500">Nu există notificări noi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>