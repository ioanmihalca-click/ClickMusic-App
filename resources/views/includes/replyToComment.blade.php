<div>
  <!-- Loop through comments -->
  @forelse ($comments->sortByDesc('created_at') as $comment)
    <!-- Single comment -->
    <li class="p-4 border border-gray-100 rounded-lg" x-data="{ open: false }">
      <div class="flex items-start">
        {{-- User avatar (if needed) --}}
        {{-- <img class="h-8 w-8 rounded-full mr-2" src="{{ $comment->user->avatar_url }}" alt="{{ $comment->user->name }}"> --}}
        <div>
          <!-- Comment author name -->
          <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
          <!-- Comment creation time -->
          <span class="text-gray-500 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>
          <!-- Comment body -->
          <div class="text-sm text-gray-700 mt-1">{{ $comment->body }}</div>
        </div>
      </div>

      <div class="mt-4 ">
        <!-- Button to toggle reply form visibility -->
        <button @click.prevent="open = !open" class="text-blue-500 mr-2">
          <!-- Display number of replies -->
          {{ $comment->replies->count() > 0 ? $comment->replies->count() . ' replies' : 'Reply' }}
        </button>
        <!-- Reply form -->
        <form x-show="open" wire:submit.prevent="addReplyToComment({{ $comment->id }})" class="flex items-center">
          <div class="mb-2 mr-2">
            <!-- Text area for replying -->
            <textarea wire:model.defer="replyToComment.{{ $comment->id }}" class="w-full border-none border-b border-gray-500 rounded-md shadow-sm focus:ring-0 resize-none" rows="1" placeholder="Reply to this comment"></textarea>
            <!-- Error message if reply validation fails -->
            @error("replyToComment.{$comment->id}") <span class="text-red-500">{{ $message }}</span> @enderror
          </div>
          <!-- Button to submit reply -->
          <button type="submit" class="p-1 text-xs font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Post Reply</button>
        </form>
      </div>

      <ul class="mt-2 space-y-2" x-show="open">
        <!-- Initialize indentation level -->
        @php $indentationLevel = 10; @endphp
        <!-- Loop through replies -->
        @foreach ($comment->replies->sortByDesc('created_at') as $reply)
          <!-- Single reply -->
          <li class="p-2 border border-gray-100 rounded-lg" style="margin-left: {{ $indentationLevel }}px;">
            <div class="flex items-start">
              {{-- User avatar (if needed) --}}
              {{-- <img class="h-6 w-6 rounded-full mr-2" src="{{ $reply->user->avatar_url }}" alt="{{ $reply->user->name }}"> --}}
              <div>
                <!-- Reply author name -->
                <span class="font-semibold text-gray-900">{{ $reply->user->name }}</span>
                <!-- Reply creation time -->
                <span class="text-gray-500 text-sm ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                <!-- Reply body -->
                <div class="text-sm text-gray-700 mt-1">{{ $reply->body }}</div>
              </div>
            </div>
          </li>
          <!-- Increase indentation level for nested replies -->
          @php $indentationLevel += 10; @endphp
        @endforeach
      </ul>
    </li>
  <!-- Handle case when there are no comments -->
  @empty
    <p>No comments yet.</p>
  @endforelse
</div>
