<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'embed_link', 'thumbnail_url', 'featured'];

    public $timestamps = true;

    // Define any other model relationships or methods here (optional)

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('reply_id'); // Maintain filter for main comments
    }

    public function allCommentsCount()
    {
        return $this->hasMany(Comment::class)->count(); // Separate method for total comment count
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function doesUserLikedVideos(){
        return $this->likes()->where('user_id', auth() ->id())->exists();
    }

}
