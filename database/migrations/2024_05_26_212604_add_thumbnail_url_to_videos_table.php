<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Video;

class AddThumbnailUrlToVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->string('thumbnail_url')->nullable()->after('embed_link');
        });

        // Set default thumbnail URL for existing videos
        $defaultThumbnailUrl = 'https://vz-7740d9b2-6d6.b-cdn.net/c0a70299-8725-4a3e-8d37-7aa83e87a25a/thumbnail.jpg'; // Your default thumbnail URL
        Video::whereNull('thumbnail_url')->update(['thumbnail_url' => $defaultThumbnailUrl]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('thumbnail_url');
        });
    }
}
