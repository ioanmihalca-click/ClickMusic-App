<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);
    }

    public function render()
    {
        $notifications = Auth::user()->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.notifications', [
            'notifications' => $notifications
        ]);
    }
}
