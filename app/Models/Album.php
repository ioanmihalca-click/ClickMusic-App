<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Album extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'albume';

    protected $fillable = [
        'titlu', 
        'slug',
        'gen_muzical', 
        'descriere', 
        'numar_trackuri', 
        'data_lansare', 
        'pret', 
        'coperta_album', 
        'file_path'
    ];

    protected $casts = [
        'pret' => 'decimal:2',
        'an_lansare' => 'integer',
        'numar_trackuri' => 'integer',
    ];

    protected $dates = ['data_lansare'];
    

    public function setTitluAttribute($value)
    {
        $this->attributes['titlu'] = $value;
        $this->attributes['slug'] = $this->generateUniqueSlug($value);
    }

    protected function generateUniqueSlug($titlu)
    {
        $slug = Str::slug($titlu);
        $count = static::where('slug', 'LIKE', "{$slug}%")
            ->where('id', '<>', $this->id)
            ->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFilePathAttribute($value)
    {
        return storage_path('storage/' . $value);
    }

    public function getCoverUrlAttribute()
    {
        return asset('storage/' . $this->coperta_album);
    }

    public function getDownloadUrlAttribute()
    {
        return asset('storage/albume/' . $this->file_path);
    }

    public function scopeLansatInAn($query, $an)
    {
        return $query->where('an_lansare', $an);
    }

    public function scopeSearch($query, $search)
{
    return $query->where('titlu', 'like', "%{$search}%")
                 ->orWhere('descriere', 'like', "%{$search}%");
}
}