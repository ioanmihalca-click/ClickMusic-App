<button type="button"
        aria-label="show notifications"
        class="font-sans text-gray-900"
        @click="open = true"
>
    <span class="sr-only">Arata notificarile</span>
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
</svg>

    @if ($unread->count() > 0)
        @if($showCount)
            <span aria-label="unread count" class="absolute top-0 left-5 aspect-square max-h-fit rounded-full border-2 bg-red-500 px-1.5 shadow leading-5 text-white font-semibold text-xs">
                {{ $unread->count() }}
            </span>
        @else
            <span aria-label="has unread notifications" class="absolute top-0 left-0 bg-red-500 rounded-full shadow aspect-square h-2/5">
        @endif
    @endif
</button>
