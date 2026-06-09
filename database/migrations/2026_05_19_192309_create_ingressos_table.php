<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Cria a tabela de ingressos da Copa do Mundo 2026.
     */
    public function up(): void
    {
        Schema::create('ingressos', function (Blueprint $table) {
            $table->id();
            $table->string('jogo', 100);      // Ex: "Brasil vs Argentina - Quartas de Final"
            $table->string('setor', 50);      // Ex: "Arquibancada Norte", "Camarotes"
            $table->decimal('preco', 10, 2);  // Preço do ingresso
            $table->integer('quantidade');    // Quantidade disponível
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingressos');
    }
};