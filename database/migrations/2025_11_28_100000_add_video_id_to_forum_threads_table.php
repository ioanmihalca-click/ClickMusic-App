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
            if (! Schema::hasColumn('forum_threads', 'video_id')) {
                $table->foreignId('video_id')
                    ->nullable()
                    ->after('category_id')
                    ->constrained('videos')
                    ->onDelete('cascade');
            }

            if (! Schema::hasColumn('forum_threads', 'is_auto_generated')) {
                $table->boolean('is_auto_generated')
                    ->default(false)
                    ->after('is_locked');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_threads', function (Blueprint $table) {
            if (Schema::hasColumn('forum_threads', 'video_id')) {
                $table->dropForeign(['video_id']);
                $table->dropColumn('video_id');
            }

            if (Schema::hasColumn('forum_threads', 'is_auto_generated')) {
                $table->dropColumn('is_auto_generated');
            }
        });
    }
};
