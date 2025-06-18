<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PremiumUpsellNotification extends Component
{
    public $show = false;
    public $dismissCount = 0;
    public $dismissedUntil = null;

    public function mount()
    {
        // Arată notificarea doar utilizatorilor free
        if (Auth::check() && !Auth::user()->isPremium()) {
            $this->dismissCount = session('upsell_dismiss_count', 0);
            $this->dismissedUntil = session('upsell_dismissed_until');

            // Verifică dacă perioada de dismiss a expirat
            if ($this->dismissedUntil && now()->lessThan($this->dismissedUntil)) {
                $this->show = false;
            } else {
                $this->show = true;
            }
        }
    }

    public function dismiss($hours = 2)
    {
        $this->dismissCount++;
        $this->dismissedUntil = now()->addHours($hours);

        // Salvează în sesiune
        session([
            'upsell_dismiss_count' => $this->dismissCount,
            'upsell_dismissed_until' => $this->dismissedUntil
        ]);

        $this->show = false;
    }

    public function render()
    {
        return view('livewire.premium-upsell-notification');
    }
}
