<div class="max-w-2xl p-16 bg-white rounded">



    @if(session()->has('megaphone_success'))
        <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
                {{ session('megaphone_success') }}
            </div>
        </div>
    @endif

    <form wire:submit.prevent="send">
       <div class="mb-6">
    <label for="type" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Tipul Notificarii') }}*</label>
    <select id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
        @error('type') border-red-500 @enderror" wire:model.live="type">
        <option value="">{{ __('Selecteaza Tipul') }}</option>
        @foreach ($notifTypes as $type => $name)
            @if (strtolower($name) === 'general')
                <option value="{{ $type }}">
                    {{ $name }}
                </option>
            @endif
        @endforeach
    </select>
</div>

        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Titlu') }}*</label>
            <input type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('title') border-red-500 @enderror" wire:model.blur="title" >
        </div>

        <div class="mb-6">
            <label for="body" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Continut') }}*</label>
            <input type="text" id="body" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('body') border-red-500 @enderror" wire:model.blur="body" >
        </div>

        <div class="mb-6">
            <label for="link" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Link URL') }}</label>
            <input type="text" id="link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" wire:model.blur="link" >
        </div>

        <div class="mb-6">
            <label for="linkText" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Link Text') }}</label>
            <input type="text" id="linkText" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" wire:model.blur="linkText">
        </div>

        <button type="submit" class="px-4 py-2 font-bold text-black bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">{{ __('Trimite') }}</button>
  
    </form>
</div>
