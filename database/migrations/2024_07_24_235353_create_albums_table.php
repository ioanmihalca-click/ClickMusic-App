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
        Schema::create('albume', function (Blueprint $table) {
            $table->id();
            $table->string('titlu')
            ->unique()
            ->index(); // Index pentru căutări rapide
            $table->string('gen_muzical')
            ->index()
            ->nullable();
            $table->text('descriere');
            $table->unsignedInteger('numar_trackuri');
            $table->date('data_lansare')->nullable();
            $table->decimal('pret', 8, 2);
            $table->string('price_id_stripe')->nullable();
            $table->string('coperta_album');
            $table->string('file_path')->nullable(); 
            $table->string('slug')->unique()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albume');
    }
};