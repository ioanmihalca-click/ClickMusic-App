<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comment_id', 'body'];
    
    protected $casts = [
        'body' => CleanHtml::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
