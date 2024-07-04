<div>
    @if (session()->has('message'))
        <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <h2 class="mb-4 text-2xl font-semibold">Blog Management</h2> 

    @if ($editing) 
        {{-- Edit/Create Form --}}
        <form wire:submit.prevent="save">
            {{-- Title Input --}}
            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-bold text-gray-700">Title:</label>
                <input type="text" wire:model="title" id="title" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" placeholder="Enter title">
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Slug Input --}}
            <div class="mb-4">
                <label for="slug" class="block mb-2 text-sm font-bold text-gray-700">Slug:</label>
                <input type="text" wire:model="slug" id="slug" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" placeholder="Enter slug (auto-generated)">
                @error('slug') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Body/Content Textarea --}}
            <div class="mb-4">
                <label for="body" class="block mb-2 text-sm font-bold text-gray-700">Content:</label>
                <textarea wire:model="body" id="body" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" rows="10" placeholder="Enter content"></textarea>
                @error('body') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Featured Image Input --}}
            <div class="mb-4">
                <label for="featured_image" class="block mb-2 text-sm font-bold text-gray-700">Featured Image:</label>
                <input type="file" wire:model="featured_image" id="featured_image">
                @error('featured_image') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            
            {{-- Meta Description Textarea --}}
            <div class="mb-4">
                <label for="meta_description" class="block mb-2 text-sm font-bold text-gray-700">Meta Description:</label>
                <textarea wire:model="meta_description" id="meta_description" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" rows="3" placeholder="Enter meta description"></textarea>
                @error('meta_description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Published Checkbox --}}
            <div class="mb-4">
                <label for="is_published" class="inline-flex items-center">
                    <input type="checkbox" wire:model="is_published" id="is_published" class="w-5 h-5 text-indigo-600 rounded form-checkbox">
                    <span class="ml-2 text-gray-700">Published</span>
                </label>
            </div>

            {{-- Published At Input --}}
            <div class="mb-4">
                <label for="published_at" class="block mb-2 text-sm font-bold text-gray-700">Published At:</label>
                <input type="datetime-local" wire:model="published_at" id="published_at" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                @error('published_at') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
 
            {{-- Save/Update Button --}}
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                @if ($postId) Update Post @else Save Post @endif
            </button>

            {{-- Cancel Button --}}
            <button wire:click="cancelEdit" type="button" class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">Cancel</button>
        </form>
    @else
        {{-- Blog Post List --}}
        <button wire:click="create" class="px-4 py-2 mb-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create New Post</button>
 
        <ul>
            @foreach ($posts as $post)
                <li class="p-4 mb-4 border rounded">
                    <a href="{{ route('blog.show', $post->slug) }}" class="font-semibold">{{ $post->title }}</a>
                    <p class="text-gray-600">{{ $post->published_at->format('F j, Y') }}</p>
                    <button wire:click="edit({{ $post->id }})" class="px-4 py-2 font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700">Edit</button>
                    <button wire:click="delete({{ $post->id }})" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                </li>
            @endforeach
        </ul>

    @endif
</div>
