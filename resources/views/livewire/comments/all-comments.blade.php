<div class="mt-8">
    <h4 class="text-lg font-semibold">{{ $video->allCommentsCount() }} Comments</h4>

    <!-- Comment Form -->
    <form wire:submit.prevent="addComment" class="mt-8">
        <div class="mb-4">
            <label for="newComment" class="block text-sm font-medium text-gray-700">Leave a Comment</label>
            <textarea wire:model.defer="newComment" id="newComment"
                class="block w-full mt-1 border-none border-b border-gray-500 rounded-md shadow-sm  focus:ring-0 resize-none"
                rows="1" placeholder="Add your comment"></textarea>
            @error('newComment') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <button type="submit"
            class="inline-flex justify-center p-1 text-xs font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Add
            Comment</button>
    </form>

    <!-- Comments Section -->
    @if ($comments->count())
        <ul class="mt-4 space-y-4">
        
            @include('includes.replyToComment' , ['comments' => $video->comments])
        </ul>
    @else
        <p class="mt-4 text-gray-500">No comments yet. Be the first to comment!</p>
    @endif
</div>
