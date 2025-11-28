<?php

namespace App\Models;

use Livewire\Attributes\Layout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Layout('layouts.app')]
class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'thread_id',
        'parent_id',
        'is_solution'
    ];

    protected $casts = [
        'is_solution' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'thread_id');
    }

    /**
     * Relație cu răspunsurile copil (nested replies)
     */
    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'parent_id');
    }

    /**
     * Relație cu răspunsul părinte
     */
    public function parent()
    {
        return $this->belongsTo(ForumReply::class, 'parent_id');
    }

    /**
     * Verifică dacă e răspuns principal (nu nested)
     */
    public function isTopLevel(): bool
    {
        return is_null($this->parent_id);
    }
}
