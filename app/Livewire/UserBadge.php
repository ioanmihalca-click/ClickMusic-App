<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserBadge extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user-badge');
    }
}
