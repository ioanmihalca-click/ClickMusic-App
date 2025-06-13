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
            // Câmpuri pentru campaniile
            $table->string('campaign_title')->nullable()->after('recipient_name');
            $table->string('campaign_subject')->nullable()->after('campaign_title');
            $table->longText('campaign_content')->nullable()->after('campaign_subject');
            $table->enum('campaign_type', ['subscriber', 'campaign'])->default('subscriber')->after('campaign_content');
            $table->timestamp('scheduled_at')->nullable()->after('failed_at');
            $table->integer('recipients_count')->default(0)->after('scheduled_at');
            $table->integer('sent_count')->default(0)->after('recipients_count');
            $table->integer('failed_count')->default(0)->after('sent_count');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null')->after('failed_count');

            // Indexuri pentru performanță
            $table->index('campaign_type');
            $table->index('scheduled_at');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newsletters', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropIndex(['campaign_type']);
            $table->dropIndex(['scheduled_at']);
            $table->dropIndex(['created_by']);

            $table->dropColumn([
                'campaign_title',
                'campaign_subject',
                'campaign_content',
                'campaign_type',
                'scheduled_at',
                'recipients_count',
                'sent_count',
                'failed_count',
                'created_by'
            ]);
        });
    }
};
