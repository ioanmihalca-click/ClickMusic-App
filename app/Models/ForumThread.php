<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'is_pinned', 'is_locked'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(ForumCategory::class);
    }
    
    public function replies()
    {
        return $this->hasMany(ForumReply::class);
    }
}