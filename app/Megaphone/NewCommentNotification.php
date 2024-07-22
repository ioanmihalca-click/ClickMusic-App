<?php

namespace App\Megaphone;

use App\Models\Comment;
use App\Models\Video;
use MBarlow\Megaphone\Types\BaseAnnouncement;


class NewCommentNotification extends BaseAnnouncement
{
    protected $comment; // Store the Comment object
    protected $title;  // Store the title
    protected $body;  // Store the body
    protected $url;  // Store the route/link

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;

        // Set title, body, and route
        $this->title = 'Un nou comment la videoclipul tău';
        $this->body = $comment->user->name . ' a lasat un comment la videoclipul tau: ' . $comment->video->title;
        $this->url = route('videos.show', ['video' => $comment->video->id]);

        // Call parent constructor to set values 
        // parent::__construct(
        //     $this->title,
        //     $this->body,
        //     $this->url 
        // );
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'link' => $this->url, // Pass $this->url to the view
        ];
    }


}