<div tabindex="0" aria-label="group icon" role="img" class="flex items-center justify-center flex-shrink-0 w-8 h-8 border border-gray-200 rounded-full focus:outline-none">
   <x-heroicon-o-bell-alert class="w-5 h-5 text-blue-500" />
</div>
<div class="w-full pl-3">
    <div class="items-center justify-between w-full pr-2">
        <p class="block w-full my-0 text-sm leading-none focus:outline-none">
            <span class="font-bold text-blue-500">
                @if(! empty($announcement['link']))
                    <a href="{{ $announcement['link'] }}">
                @endif
                        {{ $announcement['title'] }}
                        @if(! empty($announcement['link']))
                    </a>
                @endif
            </span>
        </p>
        <p class="block w-full text-sm leading-none focus:outline-none">
            {{ $announcement['body'] }}
        </p>
    </div>
    <div class="flex justify-between">
        <p class="pt-1 text-xs leading-3 text-gray-500 focus:outline-none" title="{{ $created_at->format('jS M Y H:i') }}">
            {{ $created_at->diffForHumans() }}
        </p>

        @if(! empty($announcement['link']))
            <p class="pt-1 text-xs leading-3 text-right focus:outline-none">
                <a href="{{ $announcement['link'] }}"
                   {{ ! empty($announcement['linkNewWindow']) ? ' target="_blank"' : '' }}
                   class="p-2 text-gray-800 no-underline bg-gray-100 border border-gray-300 rounded-md cursor-pointer hover:bg-gray-300">
                    {{ ! empty($announcement['linkText']) ? $announcement['linkText'] : 'View' }}
                </a>
            </p>
        @endif
    </div>
</div>
