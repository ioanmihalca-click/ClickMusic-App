<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Album;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle()
    {
        $this->info('Generating sitemap...');

        $sitemap = Sitemap::create();

        // Adaugă paginile statice principale
        $sitemap->add(Url::create('/')
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));

        $sitemap->add(Url::create('/magazin')
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.9));

        $sitemap->add(Url::create('/blog')
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.9));

        // Adaugă articolele de blog din Canvas
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

        // Adaugă albumele
        if (class_exists('App\Models\Album')) {
            Album::orderBy('created_at', 'desc')
                ->get()
                ->each(function ($album) use ($sitemap) {
                    $priority = $this->calculateAlbumPriority($album);
                    $sitemap->add(
                        Url::create(route('album.show', $album->slug))
                            ->setLastModificationDate($album->updated_at)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                            ->setPriority($priority)
                    );
                });
        }

        // Adaugă paginile statice secundare
        $secondaryPages = [
            '/newsletter' => 0.7,
            '/contact' => 0.6,
            '/politica-de-confidentialitate' => 0.6,
            '/termeni-si-conditii' => 0.6,
        ];

        foreach ($secondaryPages as $url => $priority) {
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority($priority)
            );
        }

        // Salvează sitemap-ul direct în directorul public
        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        $this->info('Sitemap generated successfully at: ' . $path);
        $this->info('File exists: ' . (file_exists($path) ? 'Yes' : 'No'));
        $this->info('File size: ' . (file_exists($path) ? filesize($path) . ' bytes' : 'N/A'));
    }

    private function calculatePostPriority($post)
    {
        $daysSincePublished = Carbon::now()->diffInDays($post->published_at);
        
        if ($daysSincePublished <= 7) {
            return 0.9;
        } elseif ($daysSincePublished <= 30) {
            return 0.8;
        }
        
        return 0.7;
    }

    private function calculateAlbumPriority($album)
    {
        $daysSinceCreated = Carbon::now()->diffInDays($album->created_at);
        
        if ($daysSinceCreated <= 30) {
            return 0.8;
        }
        
        return 0.7;
    }
}