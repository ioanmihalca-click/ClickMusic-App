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
        Schema::create('haine', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('slug')->unique();
            $table->string('categorie'); // 'hanorac', 'tricou'
            $table->text('descriere')->nullable();
            $table->string('culoare');
            $table->json('marimi_disponibile'); // ['S', 'M', 'L', 'XL', 'XXL']
            $table->decimal('pret', 8, 2);
            $table->string('price_id_stripe')->nullable();
            $table->string('payment_link')->nullable();
            $table->string('imagine_produs');
            $table->boolean('activ')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('haine');
    }
};
