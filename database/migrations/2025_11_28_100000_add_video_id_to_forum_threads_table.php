<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('forum_threads', function (Blueprint $table) {
            $table->foreignId('video_id')
                  ->nullable()
                  ->after('category_id')
                  ->constrained('videos')
                  ->onDelete('cascade');
            $table->boolean('is_auto_generated')
                  ->default(false)
                  ->after('is_locked');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_threads', function (Blueprint $table) {
            $table->dropForeign(['video_id']);
            $table->dropColumn(['video_id', 'is_auto_generated']);
        });
    }
};
