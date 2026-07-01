<?php

namespace App\Models;

use Database\Factories\SiteSettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    /** @use HasFactory<SiteSettingFactory> */
    use HasFactory;

    protected $fillable = ['homepage_youtube_url'];

    /**
     * Return the single settings row, or a fresh unsaved instance when none exists.
     */
    public static function current(): self
    {
        return static::query()->first() ?? new self;
    }

    /**
     * Build the responsive embed URL for the homepage YouTube clip.
     */
    public function getHomepageYoutubeEmbedUrlAttribute(): ?string
    {
        return static::youtubeEmbedUrl($this->homepage_youtube_url);
    }

    /**
     * Extract the 11-character video ID from any common YouTube URL format.
     */
    public static function youtubeId(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $pattern = '/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/|live\/|v\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/i';

        if (preg_match($pattern, $url, $matches) === 1) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Convert any YouTube URL into a privacy-friendly embed URL, or null when unparseable.
     */
    public static function youtubeEmbedUrl(?string $url): ?string
    {
        $id = static::youtubeId($url);

        return $id ? "https://www.youtube.com/embed/{$id}" : null;
    }
}
