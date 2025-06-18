<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class VideoDashboard extends Component
{
    public $videos;
    public $userIsPremium = false;

    public function mount()
    {
        // Verifică dacă utilizatorul are acces premium
        $this->userIsPremium = Auth::check() && Auth::user()->isPremium();

        // Use a shorter cache time or disable cache temporarily to see new uploads
        $this->videos = cache()->remember('all_videos', 5, function () {
            return Video::select('id', 'title', 'description', 'embed_link', 'thumbnail_url', 'video_path', 'created_at')
                ->latest()
                ->get();
        });
    }

    public function redirectToVideo($videoId)
    {
        return redirect()->route('videos.show', $videoId);
    }

    public function render()
    {
        return view('livewire.video-dashboard');
    }
}
