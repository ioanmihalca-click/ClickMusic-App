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
        Schema::table('users', function (Blueprint $table) {
            // Doar pentru tracking - când s-au dezabonat (opțional)
            $table->timestamp('newsletter_unsubscribed_at')->nullable()->after('email');

            // Index pentru performanță
            $table->index('newsletter_unsubscribed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['newsletter_unsubscribed_at']);
            $table->dropColumn('newsletter_unsubscribed_at');
        });
    }
};
