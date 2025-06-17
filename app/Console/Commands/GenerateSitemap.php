<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Album;
use App\Models\Haina;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle()
    {
        $this->info('Generating sitemap...');

        $sitemap = Sitemap::create();

        // Add main static pages with high priority
        $this->addStaticPages($sitemap);

        // Add dynamic content
        $this->addBlogPosts($sitemap);
        $this->addAlbums($sitemap);
        $this->addHaine($sitemap);

        // Add secondary static pages with lower priority
        $this->addSecondaryPages($sitemap);

        // Save the sitemap directly to the public directory
        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        $this->info('Sitemap generated successfully at: ' . $path);
        $this->info('File exists: ' . (file_exists($path) ? 'Yes' : 'No'));
        $this->info('File size: ' . (file_exists($path) ? filesize($path) . ' bytes' : 'N/A'));
    }

    private function addStaticPages(Sitemap $sitemap)
    {
        // Inclusă doar pagini publice (fără middleware de autentificare)
        $mainPages = [
            '/' => 1.0,
            '/press' => 0.9,
            '/magazin' => 0.9,
            '/blog' => 0.9,
            '/accespremium' => 0.8,
            '/contact' => 0.7,
        ];

        foreach ($mainPages as $url => $priority) {
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority($priority)
            );
        }
    }

    private function addBlogPosts(Sitemap $sitemap)
    {
        Post::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get()
            ->each(function (Post $post) use ($sitemap) {
                $priority = $this->calculatePostPriority($post);
                $sitemap->add(
                    Url::create(route('blog.show', $post->slug))
                        ->setLastModificationDate($post->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority($priority)
                );
            });
    }

    private function addAlbums(Sitemap $sitemap)
    {
        if (class_exists('App\Models\Album')) {
            Album::orderBy('created_at', 'desc')
                ->get()
                ->each(function ($album) use ($sitemap) {
                    $sitemap->add(
                        Url::create(route('album.show', $album->slug))
                            ->setLastModificationDate($album->updated_at)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setPriority(0.9)
                    );
                });
        }
    }

    private function addHaine(Sitemap $sitemap)
    {
        if (class_exists('App\Models\Haina')) {
            Haina::orderBy('created_at', 'desc')
                ->get()
                ->each(function ($haina) use ($sitemap) {
                    $sitemap->add(
                        Url::create(route('haina.show', $haina->slug))
                            ->setLastModificationDate($haina->updated_at)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setPriority(0.9)
                    );
                });
        }
    }

    private function addSecondaryPages(Sitemap $sitemap)
    {
        $secondaryPages = [
            '/politica-de-confidentialitate' => 0.5,
            '/termeni-si-conditii' => 0.5,
        ];

        foreach ($secondaryPages as $url => $priority) {
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority($priority)
            );
        }
    }

    private function calculatePostPriority($post)
    {
        $daysSincePublished = Carbon::now()->diffInDays($post->published_at);

        if ($daysSincePublished <= 7) {
            return 0.9;
        } elseif ($daysSincePublished <= 30) {
            return 0.8;
        } elseif ($daysSincePublished <= 90) {
            return 0.7;
        }

        return 0.6;
    }
}
