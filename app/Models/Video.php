<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'embed_link', 'thumbnail_url', 'featured', 'video_path'];

    protected $appends = ['video_url', 'thumbnail_url_full'];

    public $timestamps = true;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'featured' => 'boolean'
    ];

    // Get video URL attribute
    public function getVideoUrlAttribute()
    {
        if ($this->video_path) {
            return url('videos/stream/' . $this->id);
        }
        return null;
    }

    // Get full thumbnail URL attribute
    public function getThumbnailUrlFullAttribute()
    {
        if ($this->thumbnail_url && !filter_var($this->thumbnail_url, FILTER_VALIDATE_URL)) {
            // For file paths in storage
            return asset('storage/' . $this->thumbnail_url);
        }
        return $this->thumbnail_url;
    }

    // Define any other model relationships or methods here (optional)

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('reply_id'); // Maintain filter for main comments
    }

    public function allCommentsCount()
    {
        return $this->hasMany(Comment::class)->count(); // Separate method for total comment count
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function doesUserLikedVideos()
    {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }
}
