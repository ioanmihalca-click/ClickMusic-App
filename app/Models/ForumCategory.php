<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'is_private'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            $category->slug = str()->slug($category->name);
        });
    }

    public function threads()
    {
        return $this->hasMany(ForumThread::class, 'category_id');
    }

    public function latestThread()
    {
        return $this->hasOne(ForumThread::class)->latestOfMany();
    }

    public function replies()
    {
        return $this->hasManyThrough(ForumReply::class, ForumThread::class);
    }
}