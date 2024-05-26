<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosTableSeeder extends Seeder
{
   // VideosTableSeeder.php

public function run()
{
    $videos = [
        [
            'title' => 'Click - Prima data (feat Feli) Videoclip 2011',
            'description' => 'Video 1 Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/57f49572-46e6-4db5-b271-072b1b2bfa50?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
            'thumbnail_url' => ''
        ],
     
    ];

    DB::table('videos')->insert($videos);
}

}
