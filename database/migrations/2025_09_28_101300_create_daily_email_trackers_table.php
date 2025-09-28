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
        Schema::create('daily_email_trackers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('emails_sent')->default(0);
            $table->string('email_type')->default('video_notification');
            $table->timestamps();

            $table->unique(['date', 'email_type']);
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_email_trackers');
    }
};
