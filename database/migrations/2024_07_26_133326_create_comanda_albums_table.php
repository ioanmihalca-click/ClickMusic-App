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
        Schema::create('comanda_album', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('email');
            $table->unsignedBigInteger('album_id');
            $table->string('download_link')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
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
        Schema::dropIfExists('comanda_album');
    }
};
