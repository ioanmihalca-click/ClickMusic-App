<nav class="flex justify-center flex-1 mt-4 -mx-3">
    @auth

        <a
            href="{{ url('/videoclipuri') }}"
            class="rounded-md px-3 py-2 text-blue-400 ring-1 ring-transparent transition hover:text-blue-500 focus:outline-none focus-visible:ring-[#FF2D20] "
        >
            Intră în cont
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="rounded-md px-3 py-2 text-blue-400 ring-1 ring-transparent transition hover:text-blue-500 focus:outline-none focus-visible:ring-[#FF2D20]"
        >
            Intră în cont
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-blue-400 ring-1 ring-transparent transition hover:text-blue-500 focus:outline-none focus-visible:ring-[#FF2D20]"
            >
                Abonează-te
            </a>
        @endif
    @endauth
</nav>
