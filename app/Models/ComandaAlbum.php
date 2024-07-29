<?php

namespace App\Models;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;

class ComandaAlbum extends Model
{
    protected $table = 'comanda_album';

    protected $fillable = [
        'order_id',
        'album_id',
        'email',
        'download_link',
        'status',
    ];

    // Relația cu modelul Album
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function getDownloadUrlAttribute()
    {
        if ($this->download_link) {
            return $this->download_link;
        }
        
        // Asigurăm-ne că avem acces la album
        $album = $this->album;
        
        if (!$album) {
            // Dacă nu există albumul asociat, returnăm null sau aruncăm o excepție
            return null; // sau throw new \Exception('Album not found');
        }
        
        return URL::temporarySignedRoute(
            'album.download',
            now()->addHours(24),
            ['album' => $album->slug, 'order' => $this->order_id]
        );
    }
}
