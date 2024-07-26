<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComandaAlbum extends Model
{
    protected $fillable = ['email', 'album_id', 'download_link'];

    // Relația cu modelul Album
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
