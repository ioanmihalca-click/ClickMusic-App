<div class="mt-8">
    <h4 class="text-lg font-semibold">{{ $video->allCommentsCount() }} Comments</h4>
    @if ($comments->count())
        <ul class="mt-4 space-y-4">
            @foreach ($comments as $comment)
                <li class="p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="font-semibold">{{ $comment->user->name }}</div>
                        <button wire:click="replyToComment({{ $comment->id }})"
                            class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-400">Reply</button>
                    </div>
                    <div class="mt-2">{{ $comment->body }}</div>
                    @if ($comment->replies->count())
                        <ul class="mt-4 space-y-2">
                            @foreach ($comment->replies as $reply)
                                <li class="p-2 bg-gray-100 border border-gray-200 rounded-lg">
                                    <div class="font-semibold">{{ $reply->user->name }} (Reply)</div>
                                    <div class="mt-1">{{ $reply->body }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p class="mt-4">No comments yet. Be the first to comment!</p>
    @endif

    <form wire:submit.prevent="addComment" class="mt-8">
        <div class="mb-4">
            <label for="newComment" class="block text-sm font-medium text-gray-700">Leave a Comment</label>
            <textarea wire:model.defer="newComment" id="newComment"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                rows="3"></textarea>
            @error('newComment') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <button type="submit"
            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Add
            Comment</button>
        @if ($replyToComment)
            <p class="mt-2">Replying to comment by: {{ $comments->find($replyToComment)->user->name }}</p>
        @endif
    </form>
</div>
