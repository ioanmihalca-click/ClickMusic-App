<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign('likes_video_id_foreign'); // Drop existing foreign key
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade'); // Add new one with cascade
        });
    }

    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['video_id']); // Drop the updated foreign key (with cascade)
            $table->foreign('video_id')->references('id')->on('videos'); // Recreate the original foreign key without cascade
        });
    }
};
