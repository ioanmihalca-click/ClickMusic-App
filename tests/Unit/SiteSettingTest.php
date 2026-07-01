<?php

namespace Tests\Unit;

use App\Models\SiteSetting;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SiteSettingTest extends TestCase
{
    #[DataProvider('youtubeUrlProvider')]
    public function test_it_extracts_the_video_id_from_youtube_urls(string $url, ?string $expectedId): void
    {
        $this->assertSame($expectedId, SiteSetting::youtubeId($url));
    }

    /**
     * @return array<string, array{0: string, 1: string|null}>
     */
    public static function youtubeUrlProvider(): array
    {
        return [
            'watch url' => ['https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            'watch url without www' => ['https://youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            'short url' => ['https://youtu.be/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            'embed url' => ['https://www.youtube.com/embed/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            'shorts url' => ['https://www.youtube.com/shorts/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            'live url' => ['https://www.youtube.com/live/dQw4w9WgXcQ', 'dQw4w9WgXcQ'],
            'watch url with extra params' => ['https://www.youtube.com/watch?feature=share&v=dQw4w9WgXcQ&t=30s', 'dQw4w9WgXcQ'],
            'short url with query' => ['https://youtu.be/dQw4w9WgXcQ?si=abc123', 'dQw4w9WgXcQ'],
            'non youtube url' => ['https://vimeo.com/123456', null],
            'garbage' => ['not a url', null],
        ];
    }

    public function test_it_returns_null_id_for_empty_values(): void
    {
        $this->assertNull(SiteSetting::youtubeId(null));
        $this->assertNull(SiteSetting::youtubeId(''));
    }

    public function test_it_builds_a_privacy_friendly_embed_url(): void
    {
        $this->assertSame(
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            SiteSetting::youtubeEmbedUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ'),
        );

        $this->assertNull(SiteSetting::youtubeEmbedUrl('https://vimeo.com/123456'));
        $this->assertNull(SiteSetting::youtubeEmbedUrl(null));
    }

    public function test_the_embed_accessor_uses_the_stored_url(): void
    {
        $setting = new SiteSetting(['homepage_youtube_url' => 'https://youtu.be/dQw4w9WgXcQ']);

        $this->assertSame('https://www.youtube.com/embed/dQw4w9WgXcQ', $setting->homepage_youtube_embed_url);
    }
}
