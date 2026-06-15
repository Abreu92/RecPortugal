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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');          // Nome do equipamento
        $table->string('slug')->unique(); // URL amigável
        $table->text('description');      // Descrição técnica
        $table->decimal('price', 10, 2);  // Preço
        $table->integer('stock');         // Stock disponível
        $table->string('image_path')->nullable(); // Imagem do produto
        $table->timestamps();
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
