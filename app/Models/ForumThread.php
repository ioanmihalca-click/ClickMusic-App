<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'category_id',
        'video_id',
        'is_pinned',
        'is_locked',
        'is_auto_generated',
        'views_count'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($thread) {
            $baseSlug = str()->slug($thread->title);
            $slug = $baseSlug;
            $counter = 1;

            // Asigură slug unic
            while (static::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            $thread->slug = $slug;
        });
    }

    protected $casts = [
        'is_pinned' => 'boolean',
        'is_locked' => 'boolean',
        'is_auto_generated' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'thread_id'); // Specifică explicit cheia străină
    }

    public function latestReply()
    {
        // Specifică explicit cheia străină ca 'thread_id'
        return $this->hasOne(ForumReply::class, 'thread_id')->latestOfMany();
    }

    public function participants()
    {
        return $this->replies()->with('user')->get()->pluck('user')->unique('id');
    }

    public function incrementViewCount()
    {
        $this->increment('views_count');
    }

    public function getReplyCountAttribute()
    {
        return $this->replies()->count();
    }

    /**
     * Relație cu videoclipul asociat (pentru thread-uri auto-generate)
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    /**
     * Verifică dacă thread-ul este legat de un videoclip
     */
    public function isVideoThread(): bool
    {
        return !is_null($this->video_id);
    }
}