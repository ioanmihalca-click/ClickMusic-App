<div>
    @if (session()->has('message'))
        <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    {{-- <h2 class="mb-4 text-2xl font-semibold">Blog Management</h2>  --}}

    @if ($editing) 
        {{-- Edit/Create Form --}}
        <form wire:submit.prevent="save">
            {{-- Title Input --}}
            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-bold text-gray-700">Titlu:</label>
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
    <label for="body" class="block mb-2 text-sm font-bold text-gray-700">Continut:</label>
    <div x-data="editor()" class="relative">
        <div class="flex mb-2 space-x-2">
            <button @click.prevent="format('bold')" class="px-2 py-1 font-bold bg-gray-200 rounded">B</button>
            <button @click.prevent="format('italic')" class="px-2 py-1 italic bg-gray-200 rounded">I</button>
            <button @click.prevent="format('underline')" class="px-2 py-1 underline bg-gray-200 rounded">U</button>
            <button @click.prevent="format('h2')" class="px-2 py-1 bg-gray-200 rounded">H2</button>
            <button @click.prevent="format('h3')" class="px-2 py-1 bg-gray-200 rounded">H3</button>
            <button @click.prevent="format('insertUnorderedList')" class="px-2 py-1 bg-gray-200 rounded">List</button>
            <button @click.prevent="format('br')" class="px-2 py-1 bg-gray-200 rounded">BR</button>
        </div>
        
        <div class="flex my-2 space-x-2">  
            <input 
                type="text" 
                x-model="embedLink" 
                @keydown.enter.prevent="insertEmbed"
                placeholder="Adauga un link Youtube si apasa Enter"
                class="w-full px-2 py-1 border rounded focus:outline-none focus:ring focus:border-blue-300"
            >
            <button @click.prevent="insertEmbed" class="px-2 py-1 bg-gray-200 rounded">Embed</button>
            <button @click.prevent="togglePreview" class="px-2 py-1 text-white bg-blue-500 rounded">
                <span x-text="preview ? 'Edit' : 'Preview'"></span>
            </button>
        </div>

        <div x-show="!preview">
            <textarea 
                x-ref="textarea"
                wire:model.defer="body" 
                id="body" 
                rows="10" 
                placeholder="Enter content"
                class="w-full px-3 py-2 text-gray-700 border rounded shadow-sm focus:outline-none focus:ring focus:ring-blue-500"
                @input="updateContent"
            ></textarea>
        </div>

        <div x-show="preview" x-html="previewContent" class="p-4 mt-2 prose border rounded lg:prose-xl max-w-none"></div>
    </div>
    @error('body') <span class="text-red-500">{{ $message }}</span> @enderror
</div>



            {{-- Featured Image Input --}}
            <div class="mb-4">
    <label for="featured_image" class="block mb-2 text-sm font-bold text-gray-700">Imagine:</label>
    <input type="file" wire:model="featured_image" id="featured_image">
    @error('featured_image') <span class="text-red-500">{{ $message }}</span> @enderror

    @if ($featured_image)
        <img src="{{ $featured_image->temporaryUrl() }}" class="mt-2 max-h-40">
    @elseif ($existing_featured_image)
        <img src="{{ asset('storage/' . $existing_featured_image) }}" class="mt-2 max-h-40">
    @endif
</div>

            
            {{-- Meta Description Textarea --}}
            <div class="mb-4">
                <label for="meta_description" class="block mb-2 text-sm font-bold text-gray-700">Meta Descriere:</label>
                <textarea wire:model="meta_description" id="meta_description" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" rows="3" placeholder="Enter meta description"></textarea>
                @error('meta_description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            {{-- Published At Input --}}
            <div class="mb-4">
                <label for="published_at" class="block mb-2 text-sm font-bold text-gray-700">Publicat la:</label>
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
        <button wire:click="create" class="px-4 py-2 mb-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Adauga Articol</button>
 
        <ul>
            @foreach ($posts as $post)
        <li class="p-4 mb-4 border rounded">
            <a href="{{ route('blog.show', $post->slug) }}" class="font-semibold">{{ $post->title }}</a>
            <p class="text-gray-600">{{ $post->published_at->format('F j, Y') }}</p>
            <button wire:click="edit('{{ $post->id }}')" class="px-4 py-2 font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700">Edit</button>
            <button wire:click="delete('{{ $post->id }}')" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
        </li>
    @endforeach
        </ul>

    @endif
</div>
<script>
function editor() {
    return {
        preview: false,
        previewContent: '',
        embedLink: '',

        format(command) {
            let textarea = this.$refs.textarea;
            let start = textarea.selectionStart;
            let end = textarea.selectionEnd;
            let selectedText = textarea.value.substring(start, end);

            let formattedText = selectedText;
            switch (command) {
                case 'bold':
                    formattedText = `<strong>${selectedText}</strong>`;
                    break;
                case 'italic':
                    formattedText = `<em>${selectedText}</em>`;
                    break;
                case 'underline':
                    formattedText = `<u>${selectedText}</u>`;
                    break;
                case 'h2':
                    formattedText = `<h2>${selectedText}</h2>`;
                    break;
                case 'h3':
                    formattedText = `<h3>${selectedText}</h3>`;
                    break;
                case 'ul':
                    formattedText = `<ul><li>${selectedText}</li></ul>`;
                    break;
                case 'br':
                    formattedText = `${selectedText}<br>`;
                    break;
            }

            textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
            this.updateContent();

            textarea.focus();
            textarea.setSelectionRange(start + formattedText.length, start + formattedText.length);
        },

        updateContent() {
            this.$wire.set('body', this.$refs.textarea.value);
            // Only update preview when in preview mode
            if (this.preview) {
                this.previewContent = this.$refs.textarea.value;
            }
        },

        togglePreview() {
            this.preview = !this.preview;
            if (this.preview) {
                this.previewContent = this.$refs.textarea.value;
            }
        },

        insertEmbed() {
            if (!this.embedLink) return;

            let textarea = this.$refs.textarea;
            let start = textarea.selectionStart;

            // Improved YouTube link detection (including shorts and share links)
            const youtubeRegex = /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?([\w-]{11})(?:\S+)?$/;
            const match = this.embedLink.match(youtubeRegex);

            if (match) {
                let videoId = match[1]; // Extract the video ID

                // Responsive Embed Code Generation
                let embedCode = `<div class="relative mx-auto overflow-hidden" style="padding-bottom: 56.25%;">
                                    <iframe 
                                        class="absolute top-0 left-0 w-full h-full"
                                        src="https://www.youtube.com/embed/${videoId}" 
                                        title="YouTube video player" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen
                                    ></iframe>
                                </div>`;

                textarea.value = textarea.value.substring(0, start) + embedCode + textarea.value.substring(start);
            } else {
                // For other embeds, insert the link as plain text
                textarea.value = textarea.value.substring(0, start) + this.embedLink + textarea.value.substring(start);
            }

            this.updateContent();
            this.embedLink = ''; // Clear the input after inserting
        }
    };
}
</script>