@foreach ($comments as $comment)
    <li class="p-5 glass-card transition-all duration-300"
        x-data="{ open: false }">
        <div class="flex flex-col">
            <div class="flex items-center">
                @if ($comment->user && $comment->user->usertype === 'admin')
                    <span class="inline-flex items-center justify-center p-1 mr-2 rounded-full bg-blue-600/20">
                        <x-heroicon-o-shield-check class="w-4 h-4 text-blue-400" />
                    </span>
                @endif
                <span class="font-semibold text-white">{{ $comment->user->name }}</span>
                <span class="ml-2 text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="mt-3 text-sm text-gray-300">{{ $comment->body }}</div>
        </div>

        <div class="mt-4">
            <button @click.prevent="open = !open"
                class="flex items-center text-sm text-blue-400 transition-colors duration-200 hover:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                </svg>
                {{ $comment->replies->count() > 0 ? $comment->replies->count() . ' răspunsuri' : 'Răspunde' }}
            </button>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100">
            <ul class="pl-4 mt-4 ml-5 space-y-4 border-l-2 border-sky-400/30">
                @foreach ($comment->replies->sortByDesc('created_at') as $reply)
                    <li class="p-4 glass-card">
                        <div class="flex flex-col">
                            <div class="flex items-center">
                                @if ($reply->user && $reply->user->usertype === 'admin')
                                    <span
                                        class="inline-flex items-center justify-center p-1 mr-2 rounded-full bg-blue-600/20">
                                        <x-heroicon-o-shield-check class="w-3 h-3 text-blue-400" />
                                    </span>
                                @endif
                                <span class="font-semibold text-white">{{ $reply->user->name }}</span>
                                <span
                                    class="ml-2 text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="mt-2 text-sm text-gray-300">{{ $reply->body }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <form wire:submit.prevent="addReplyToComment({{ $comment->id }})" class="pl-4 mt-4 ml-5">
                <div class="mb-2">
                    <textarea wire:model.defer="replyToComment.{{ $comment->id }}"
                        class="w-full p-2 text-white transition-all duration-300 rounded-2xl resize-none bg-slate-900/60 border border-white/10 backdrop-blur-xl focus:border-sky-300/60 focus:ring-2 focus:ring-sky-400/40 focus:outline-none"
                        rows="2" placeholder="Răspunde la acest comentariu..."></textarea>
                    @error("replyToComment.{$comment->id}")
                        <span class="mt-1 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="glass-button px-4 py-2 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                        </svg>
                        Trimite
                    </button>
                </div>
            </form>
        </div>
    </li>
@endforeach
