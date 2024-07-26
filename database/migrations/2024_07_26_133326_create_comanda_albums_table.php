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
        Schema::create('comanda_albums', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->unsignedBigInteger('album_id');
            $table->string('download_link')->nullable();
            $table->timestamps(); // Created_at, updated_at

             // Foreign key constraint
    $table->foreign('album_id')->references('id')->on('albume')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comanda_albums');
    }
};
