<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComandaHaina extends Model
{
    protected $table = 'comanda_haina';

    protected $fillable = [
        'order_id',
        'haina_id',
        'email',
        'nume_cumparator',
        'telefon',
        'adresa_livrare',
        'marime_selectata',
        'status'
    ];

    protected $casts = [];

    // Relația cu modelul Haina
    public function haina()
    {
        return $this->belongsTo(Haina::class);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}
