<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Haina extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'haine';

    protected $fillable = [
        'nume',
        'slug',
        'categorie',
        'descriere',
        'culoare',
        'marimi_disponibile',
        'pret',
        'price_id_stripe',
        'payment_link',
        'imagine_produs',
        'activ'
    ];

    protected $casts = [
        'pret' => 'decimal:2',
        'marimi_disponibile' => 'array',
        'activ' => 'boolean',
    ];

    public function setNumeAttribute($value)
    {
        $this->attributes['nume'] = $value;
        $this->attributes['slug'] = $this->generateUniqueSlug($value);
    }

    protected function generateUniqueSlug($nume)
    {
        $slug = Str::slug($nume);
        $count = static::where('slug', 'LIKE', "{$slug}%")
            ->where('id', '<>', $this->id)
            ->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->imagine_produs);
    }

    public function getImageUrlFullAttribute()
    {
        return url('storage/' . $this->imagine_produs);
    }

    public function scopeActiv($query)
    {
        return $query->where('activ', true);
    }

    public function scopeCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('nume', 'like', "%{$search}%")
            ->orWhere('descriere', 'like', "%{$search}%")
            ->orWhere('categorie', 'like', "%{$search}%");
    }

    public function hasSize($size)
    {
        return in_array($size, $this->marimi_disponibile ?? []);
    }

    public function getPriceIdStripeAttribute()
    {
        return $this->attributes['price_id_stripe'];
    }
}
