@foreach ($comments->sortByDesc('created_at') as $comment)
    <li class="p-4 border border-gray-100 rounded-lg" x-data="{ open: false }">
        <div class="flex items-start">
            <!-- Avatar (You can uncomment this when you're ready to add avatars) -->
            {{-- <img class="h-8 w-8 rounded-full mr-2" src="{{ $comment->user->avatar_url }}" alt="{{ $comment->user->name }}"> --}}
            <div>
                <!-- Username -->
                <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                <!-- Timestamp -->
                <span class="text-gray-500 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                <!-- Comment Body -->
                <div class="text-sm text-gray-700 mt-1">{{ $comment->body }}</div>
                <!-- Replies -->
                @if ($comment->replies->count())
                <!-- Reply Form -->
                <div class="mt-4">
                    <button @click="open = !open" class="text-black">Reply</button>
                    <!-- Form for replying -->
                    <form x-show="open" wire:submit.prevent="addReplyToComment({{ $comment->id }})" class="mt-2  gap-3 flex items-center justify-end">
                        <div class="mb-2">
                            <textarea wire:model.defer="replyToComment.{{ $comment->id }}" class="w-full border-none border-b border-gray-500 rounded-md shadow-sm focus:ring-0 resize-none" rows="1" placeholder="Reply to this comment"></textarea>
                            @error("replyToComment.{$comment->id}") <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="p-1 text-xs font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Post Reply</button>
                    </form>
                </div>

            </div>
        </div>
                    <div class="mt-2 pl-6">
                        <!-- Anchor tag to toggle visibility of replies -->
                        <a href="#" class="text-blue-500" @click.prevent="open = !open">{{ $comment->replies->count() }} replies</a>
                        <!-- List of replies, conditionally shown based on 'open' -->
                        <ul class="mt-2 space-y-2" x-show="open">
                            <!-- Loop through replies -->
                            @php $indentationLevel = 10; @endphp
                            @foreach ($comment->replies->sortByDesc('created_at') as $reply)
                                <!-- Individual reply item -->
                                <li class="p-2 border border-gray-100 rounded-lg" style="margin-left: {{ $indentationLevel }}px;">
                                    <div class="flex items-start">
                                        <!-- Avatar (You can uncomment this when you're ready to add avatars) -->
                                        {{-- <img class="h-6 w-6 rounded-full mr-2" src="{{ $reply->user->avatar_url }}" alt="{{ $reply->user->name }}"> --}}
                                        <div>
                                            <!-- Reply Username -->
                                            <span class="font-semibold text-gray-900">{{ $reply->user->name }}</span>
                                            <!-- Reply Timestamp -->
                                            <span class="text-gray-500 text-sm ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                                            <!-- Reply Body -->
                                            <div class="text-sm text-gray-700 mt-1">{{ $reply->body }}</div>
                                        </div>
                                    </div>
                                </li>
                                @php $indentationLevel += 10; @endphp
                            @endforeach
                        </ul>
                    </div>
                @endif

    </li>
@endforeach
