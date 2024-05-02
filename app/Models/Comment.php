<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'video_id', 'reply_id', 'body'];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc'); // Corrected order column name
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Relationship with User model
    }

    public function video()
    {
        return $this->belongsTo(Video::class); // Relationship with Video model
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id' , 'id'); // Corrected second argument (foreign key on replies table)
    }

   public function parent()
   {
     return $this->belongsTo(Comment::class, 'reply_id'); // Relationship for parent comment
  }
}
