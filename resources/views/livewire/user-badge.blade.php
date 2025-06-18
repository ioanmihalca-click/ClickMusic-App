<div>
    @if ($user->usertype === 'admin')
        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-900/40 text-red-400 border border-red-500/30">
            Admin
        </span>
    @elseif($user->usertype === 'super_user')
        <span
            class="px-2 py-1 text-xs font-medium rounded-full bg-purple-900/40 text-purple-400 border border-purple-500/30">
            Super User
        </span>
    @elseif($user->hasPremiumBadge())
        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-900/40 text-blue-400 border border-blue-500/30">
            Premium
        </span>
    @else
        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-800/40 text-gray-400 border border-gray-600/30">
            Free
        </span>
    @endif
</div>
