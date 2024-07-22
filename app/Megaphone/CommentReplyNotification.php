<?php

namespace App\Megaphone;

use App\Models\Comment;
use App\Models\Video;
use MBarlow\Megaphone\Types\BaseAnnouncement;

class CommentReplyNotification extends BaseAnnouncement
{
    protected $reply, $video, $title, $body, $route, $url;
  

    public function __construct(Comment $reply, Video $video)
    {
        $this->reply = $reply;
        $this->video = $video;
        
        // Set title, body, and route
        $this->title = $reply->user->name . ' a răspuns la comentariul tău de la "' . $video->title . '"!';
        $this->body = $reply->body;
        $this->route = route('videos.show', ['video' => $video->id]);
        

        parent::__construct(
            $this->title, // Title
            $this->body, // Body
            $this->route // Route
        );
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'link' => $this->url,
            'video_title' => $this->video->title,
            
        ];
    }
}