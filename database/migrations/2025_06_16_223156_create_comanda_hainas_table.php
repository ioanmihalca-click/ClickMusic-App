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
        Schema::create('comanda_haina', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('haina_id')->constrained('haine')->onDelete('cascade');
            $table->string('email');
            $table->string('nume_cumparator');
            $table->string('telefon')->nullable();
            $table->text('adresa_livrare');
            $table->string('marime_selectata');
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comanda_haina');
    }
};
