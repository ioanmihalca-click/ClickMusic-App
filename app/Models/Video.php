<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'embed_link'];

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

    // **Optional: Using a Global Scope (requires modifying Comment model)**

    // public function scopeActive($query)
    // {
    //     return $query->whereNull('deleted_at'); // Filter out deleted comments (if applicable)
    // }

    // public static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope(new ActiveScope); // Apply global scope to all Comment queries
    // }
}
