<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class VideoUpsellOverlay extends Component
{
    public $videoId;

    public function mount($videoId)
    {
        $this->videoId = $videoId;
    }
    public function redirectToSubscription()
    {
        return redirect()->route('abonament')
            ->with('upsell', 'Pentru a asculta sau viziona acest conținut, ai nevoie de un abonament premium.');
    }

    public function render()
    {
        return view('livewire.video-upsell-overlay');
    }
}
