<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosTableSeeder extends Seeder
{
   // VideosTableSeeder.php

public function run()
{
    $videos = [
        [
            'title' => 'Click - Viata mea (ft Mihai Stanciuc)',
            'description' => 'Video Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/75e751bc-5464-45fd-897b-1ebf5491976e?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
            'thumbnail_url' => 'https://vz-7740d9b2-6d6.b-cdn.net/75e751bc-5464-45fd-897b-1ebf5491976e/thumbnail.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        
        [
            'title' => 'Click - De dragoste si razboi (ft El Nino & Miss Marry)',
            'description' => 'Video Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/527f3b5f-fdea-4988-aa02-5d0086e1f46f?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
            'thumbnail_url' => 'https://vz-7740d9b2-6d6.b-cdn.net/527f3b5f-fdea-4988-aa02-5d0086e1f46f/thumbnail.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],

        [
            'title' => 'Click - Visul (ft Iolanda)',
            'description' => 'Video Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/bdae1a02-f620-4953-9572-63d46aee4dd2?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
            'thumbnail_url' => 'https://vz-7740d9b2-6d6.b-cdn.net/bdae1a02-f620-4953-9572-63d46aee4dd2/thumbnail_a2665a01.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        
        [
            'title' => 'Click - Viata-i o lupta',
            'description' => 'Video Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/967a1a3c-0ed2-4a70-addf-71be6d2d4644?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
            'thumbnail_url' => 'https://vz-7740d9b2-6d6.b-cdn.net/967a1a3c-0ed2-4a70-addf-71be6d2d4644/thumbnail.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => 'Click - Strig tare',
            'description' => 'Video Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/31efc5c8-bade-4558-8b6a-dbfcbf00cdd6?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
            'thumbnail_url' => 'https://vz-7740d9b2-6d6.b-cdn.net/31efc5c8-bade-4558-8b6a-dbfcbf00cdd6/thumbnail.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
     
    ];

    DB::table('videos')->insert($videos);
}

}
