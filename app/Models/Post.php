<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'canvas_posts';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title', 'slug', 'body', 'meta', 'featured_image', 'published_at'
    ];

    protected $casts = [
        'meta' => 'array',
        'published_at' => 'datetime',
    ];

    protected $appends = ['read_time'];

    // Automatically generate slug on save
    protected static function booted()
    {
        parent::boot();

        static::saving(function (Post $post) {
            $post->slug = Str::slug($post->title);
        });
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    // Accessors
    public function getReadTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->body));
        $minutes = ceil($words / 200); // Average reading speed: 200 words/minute
        return $minutes . ' min read';
    }

    public function getSummaryAttribute()
    {
        return Str::words(strip_tags($this->body), 30); // Show the first 30 words as summary
    }

    public function getUrlAttribute()
    {
        return route('blog.show', $this->slug);
    }
}