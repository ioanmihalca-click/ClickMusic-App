@foreach ($comments as $comment)
    <li class="p-4 border border-gray-100 rounded-lg">
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
                    <div class="mt-2 pl-6">
                        <a href="#" class="text-blue-500">{{ $comment->replies->count() }} replies</a>
                        <ul class="mt-2 space-y-2">
                            @foreach ($comment->replies as $index => $reply)
                                <li class="p-2 border border-gray-100 rounded-lg" style="margin-left: {{ $index * 10 }}px;">
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
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </li>
@endforeach
