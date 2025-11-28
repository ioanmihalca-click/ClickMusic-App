<?php

namespace App\Services;

use App\Models\Video;
use App\Models\ForumThread;
use App\Models\ForumCategory;
use Illuminate\Support\Facades\Log;

class VideoForumService
{
    /**
     * Creează un thread în forum pentru un videoclip nou
     *
     * @param Video $video Videoclipul pentru care se creează thread-ul
     * @return ForumThread
     */
    public function createThreadForVideo(Video $video): ForumThread
    {
        $category = $this->getOrCreateVideoclipuriCategory();
        $systemUserId = config('app.system_user_id', 1);

        $thread = ForumThread::create([
            'title' => $video->title,
            'content' => $this->buildThreadContent($video),
            'user_id' => $systemUserId,
            'category_id' => $category->id,
            'video_id' => $video->id,
            'is_auto_generated' => true,
            'is_pinned' => false,
            'is_locked' => false,
        ]);

        Log::info("Thread forum creat pentru video: {$video->title}", [
            'video_id' => $video->id,
            'thread_id' => $thread->id,
        ]);

        return $thread;
    }

    /**
     * Obține sau creează categoria "Videoclipuri"
     *
     * @return ForumCategory
     */
    protected function getOrCreateVideoclipuriCategory(): ForumCategory
    {
        return ForumCategory::firstOrCreate(
            ['slug' => 'videoclipuri'],
            [
                'name' => 'Videoclipuri',
                'description' => 'Discuții despre videoclipurile Click Music',
                'color' => '#9333ea',
                'is_private' => false,
            ]
        );
    }

    /**
     * Construiește conținutul thread-ului pentru un videoclip
     *
     * @param Video $video
     * @return string
     */
    protected function buildThreadContent(Video $video): string
    {
        $content = "Discută despre videoclipul **{$video->title}**.";

        if ($video->description) {
            $content .= "\n\n" . $video->description;
        }

        return $content;
    }
}
