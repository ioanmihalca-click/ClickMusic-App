<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    protected $fillable = ['content', 'user_id', 'thread_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function thread()
    {
        return $this->belongsTo(ForumThread::class);
    }
}