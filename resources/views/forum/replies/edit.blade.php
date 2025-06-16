<x-app-layout>
    <div class="min-h-screen py-12 bg-black">
        <div class="px-4 mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white">Editează răspuns</h1>
                <p class="mt-2 text-gray-400">Fă modificările necesare și salvează</p>
            </div>

            @if (session('error'))
                <div class="p-4 mb-6 text-red-700 bg-red-100 border-l-4 border-red-500 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <div class="p-6 bg-gray-800 border border-gray-700 rounded-xl">
                <form action="{{ route('forum.replies.update', $reply) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="content" class="block mb-1 text-sm font-medium text-gray-300">Conținut</label>
                        <textarea id="content" name="content" rows="8"
                            class="w-full px-3 py-2 text-white bg-gray-700 border border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            required>{{ old('content', $reply->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('forum.threads.show', $reply->thread) }}"
                            class="px-4 py-2 text-gray-300 bg-gray-700 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            Anulează
                        </a>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Salvează modificările
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
