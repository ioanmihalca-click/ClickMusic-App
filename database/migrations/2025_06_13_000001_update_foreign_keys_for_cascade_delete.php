<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - Update foreign keys to cascade on delete
     */
    public function up(): void
    {
        // Drop existing foreign keys
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['video_id']);
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['video_id']);
        });

        // Add new foreign keys with cascade on delete
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->onDelete('cascade');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        // Drop cascade constraints
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['video_id']);
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['video_id']);
        });

        // Add back original constraints without cascading
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('video_id')
                ->references('id')
                ->on('videos');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('video_id')
                ->references('id')
                ->on('videos');
        });
    }
};
