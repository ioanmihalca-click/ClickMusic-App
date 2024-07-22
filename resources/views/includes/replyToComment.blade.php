@foreach($comments as $comment)
    <li class="p-4 border border-gray-100 rounded-lg" x-data="{ open: false }">
        <div class="flex flex-col">
            <div class="flex items-center">
                @if ($comment->user && $comment->user->usertype === 'admin')
                    <x-heroicon-o-shield-check class="inline-block w-4 h-4 pb-0.5 text-blue-500"  /> 
                @endif
                <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                <span class="ml-2 text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="mt-1 text-sm text-gray-700">{{ $comment->body }}</div>
        </div>

        <div class="mt-4 ml-4">
            <button @click.prevent="open = !open" class="mr-2 text-blue-500">
                {{ $comment->replies->count() > 0 ? $comment->replies->count() . ' replies' : 'Reply' }}
            </button>
        </div>

        <div x-show="open">
            <ul class="mt-2 ml-4 space-y-2">
                @foreach ($comment->replies->sortByDesc('created_at') as $reply)
                    <li class="p-2 border border-gray-100 rounded-lg">
                        <div class="flex flex-col">
                            <div class="flex items-center">
                                @if ($reply->user && $reply->user->usertype === 'admin')
                                    <x-heroicon-o-shield-check class="inline-block w-4 h-4 pb-0.5 text-blue-500"  />
                                @endif
                                <span class="font-semibold text-gray-900">{{ $reply->user->name }}</span>
                                <span class="ml-2 text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="mt-1 text-sm text-gray-700">{{ $reply->body }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <form wire:submit.prevent="addReplyToComment({{ $comment->id }})" class="flex items-center mt-4 ml-4">
                <div class="flex-grow mb-2 mr-2">
                    <textarea wire:model.defer="replyToComment.{{ $comment->id }}" class="w-full border-b border-gray-500 border-none rounded-md shadow-sm resize-none focus:ring-0" rows="1" placeholder="Reply to this comment"></textarea>
                    @error("replyToComment.{$comment->id}") <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="p-1 text-xs font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Post Reply</button>
            </form>
        </div>
    </li>
@endforeach