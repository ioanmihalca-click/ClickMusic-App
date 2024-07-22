@foreach($comments as $comment)
    <li class="p-4 border border-gray-100 rounded-lg" x-data="{ open: false }">
        <div class="flex items-center"> {{-- Changed to items-center --}}
            @if ($comment->user && $comment->user->usertype === 'admin')
                <x-heroicon-o-shield-check class="inline-block w-4 h-4 mr-1 text-blue-500 align-middle" /> 
            @endif
            <div class="flex items-baseline">
            {{-- User avatar (if needed) --}}
            {{-- <img class="w-8 h-8 mr-2 rounded-full" src="{{ $comment->user->avatar_url }}" alt="{{ $comment->user->name }}"> --}}
            <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
            <span class="ml-2 text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                <div class="mt-1 text-sm text-gray-700">{{ $comment->body }}</div>
            </div>
        </div>

        <div class="mt-4 ">
            <button @click.prevent="open = !open" class="mr-2 text-blue-500">
                {{ $comment->replies->count() > 0 ? $comment->replies->count() . ' replies' : 'Reply' }}
            </button>
            <form x-show="open" wire:submit.prevent="addReplyToComment({{ $comment->id }})" class="flex items-center">
                <div class="mb-2 mr-2">
                    <textarea wire:model.defer="replyToComment.{{ $comment->id }}" class="w-full border-b border-gray-500 border-none rounded-md shadow-sm resize-none focus:ring-0" rows="1" placeholder="Reply to this comment"></textarea>
                    @error("replyToComment.{$comment->id}") <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="p-1 text-xs font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Post Reply</button>
            </form>
        </div>

        <ul class="mt-2 space-y-2" x-show="open">
            @php $indentationLevel = 10; @endphp
            @foreach ($comment->replies->sortByDesc('created_at') as $reply)
                <li class="p-2 border border-gray-100 rounded-lg" style="margin-left: {{ $indentationLevel }}px;">
                    <div class="flex items-center">
                        {{-- User avatar (if needed) --}}
                        {{-- <img class="w-6 h-6 mr-2 rounded-full" src="{{ $reply->user->avatar_url }}" alt="{{ $reply->user->name }}"> --}}

                        @if ($reply->user && $reply->user->usertype === 'admin')
                            <x-heroicon-o-shield-check class="inline-block w-4 h-4 mr-1 text-blue-500 align-middle" />
                        @endif

                        <div class="flex items-baseline">
                            <span class="font-semibold text-gray-900">{{ $reply->user->name }}</span>
                            <span class="ml-2 text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                            <div class="mt-1 text-sm text-gray-700">{{ $reply->body }}</div>
                        </div>
                    </div>
                </li>
                @php $indentationLevel += 10; @endphp
            @endforeach
        </ul>
    </li>
@endforeach
