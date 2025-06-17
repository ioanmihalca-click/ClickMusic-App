<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationsMenu extends Component
{

    public function getNotificationsProperty()
    {
        // Get the latest 5 notifications for the current user
        return Auth::user()->notifications()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function getUnreadCountProperty()
    {
        return Auth::user()->unreadNotificationsCount();
    }

    public function toggleNotifications()
    {
        // This method is no longer needed, but keeping it for backward compatibility
    }

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
        return view('livewire.notifications-menu');
    }
}
