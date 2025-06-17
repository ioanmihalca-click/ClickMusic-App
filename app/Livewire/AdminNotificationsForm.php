<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class AdminNotificationsForm extends Component
{
    public $title;
    public $body;
    public $link;
    public $recipientType = 'all';
    public $notificationType = 'general';

    protected $rules = [
        'title' => 'required|min:5|max:100',
        'body' => 'required|min:10|max:500',
        'link' => 'nullable|url',
        'recipientType' => 'required|in:all,subscribers,premium',
        'notificationType' => 'required|in:general,important,new_feature',
    ];

    public function mount()
    {
        $this->link = route('videoclipuri');
    }

    public function sendNotification(NotificationService $notificationService)
    {
        $this->validate();

        // Get recipients based on selection
        $users = $this->getRecipients();

        if ($users->isEmpty()) {
            session()->flash('error', 'Nu există utilizatori care să primească notificarea.');
            return;
        }

        // Send notification to each user
        foreach ($users as $user) {
            $notificationService->sendToUser(
                $user,
                $this->notificationType,
                $this->title,
                $this->body,
                $this->link
            );
        }

        // Reset form
        $this->reset(['title', 'body']);
        $this->link = route('videoclipuri');

        // Flash message
        session()->flash('success', 'Notificarea a fost trimisă cu succes către ' . $users->count() . ' utilizatori.');
    }

    private function getRecipients()
    {
        switch ($this->recipientType) {
            case 'subscribers':
                return User::newsletterSubscribed()->get();
            case 'premium':
                return User::whereHas('subscriptions', function ($query) {
                    $query->where('stripe_status', 'active');
                })->get();
            case 'all':
            default:
                return User::all();
        }
    }

    public function render()
    {
        return view('livewire.admin-notifications-form', [
            'userCount' => User::count(),
            'subscriberCount' => User::newsletterSubscribed()->count(),
            'premiumCount' => User::whereHas('subscriptions', function ($query) {
                $query->where('stripe_status', 'active');
            })->count(),
        ]);
    }
}
