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
}
