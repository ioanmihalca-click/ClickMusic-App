<div x-data="{ isLiked: @entangle('isLiked') }">
    <button class="flex items-center px-2 py-1 text-xs transition-colors duration-300 focus:outline-none"
        :class="isLiked ? 'text-blue-600 hover:text-blue-700' : 'text-gray-600 hover:text-gray-700'"
        wire:click="toggleLike" wire:loading.attr="disabled">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 mr-1 transition-colors duration-300"
            :class="{ 'text-blue-600': isLiked, 'text-gray-400': !isLiked }" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 3.105c2.198-3.29 8-3.29 8 4.63 0 4.358-2.462 6.906-5.792 9.28-1.464 1.133-2.143 1.787-2.208 1.846-.061-.054-.757-.715-2.208-1.846C4.462 14.611 2 12.063 2 7.695 2 3.785 7.802.815 10 3.105z"
                clip-rule="evenodd" />
        </svg>
        <span wire:loading.remove x-text="isLiked ? 'Unlike' : 'Like'"></span>

        <span class="ml-2">{{ $likeCount }}</span>
    </button>
</div>
