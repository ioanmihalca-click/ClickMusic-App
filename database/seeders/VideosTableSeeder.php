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
            'title' => 'Click - Viata omului prod. by Warrior Transmission (Videoclip)',
            'description' => 'Video 1 Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/840ebe98-8e86-4ae9-b9af-395738fec815?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
        ],
        [
            'title' => 'Click - Vino la dans prod. by Warrior Transmission (Videoclip)',
            'description' => 'Video 2 Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/bee71705-3f3a-4be7-8413-62338d6662c6?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
        ],

    [
            'title' => 'Click - Prietenie (prod MdBeatz)',
            'description' => 'Video 2 Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/0c4f581f-95b9-48e6-b0f1-afd94a07e64e?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
        ],
        [
            'title' => 'Borealis x Click - Trec peste rele (Videoclip)
            ',
            'description' => 'Video 2 Description',
            'embed_link' => '<div style="position:relative;padding-top:56.25%;"><iframe src="https://iframe.mediadelivery.net/embed/233943/5337f7bd-dda3-4400-8e1e-b2171af4f786?autoplay=true&loop=false&muted=false&preload=false&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true"></iframe></div>',
        ],
    ];

    DB::table('videos')->insert($videos);
}

}
