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
        Schema::table('newsletters', function (Blueprint $table) {
            $table->timestamp('failed_at')->nullable()->after('sent_at');
            $table->text('error_message')->nullable()->after('failed_at');

            // Adăugăm și un index pentru performanță pe queries frecvente
            $table->index(['status', 'sent_at']);
            $table->index(['status', 'failed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newsletters', function (Blueprint $table) {
            $table->dropIndex(['status', 'sent_at']);
            $table->dropIndex(['status', 'failed_at']);
            $table->dropColumn(['failed_at', 'error_message']);
        });
    }
};
