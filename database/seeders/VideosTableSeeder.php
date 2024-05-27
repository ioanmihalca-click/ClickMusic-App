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
            'title' => '',
            'description' => '',
            'embed_link' => '',
            'thumbnail_url' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        
        
     
    ];

    DB::table('videos')->insert($videos);
}

}
