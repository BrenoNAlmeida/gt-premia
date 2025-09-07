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
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('aprovado');
            $table->foreignId('carteira_id')->nullable()->constrained('carteiras');
            $table->foreignId('premio_retirado_id')->nullable()->constrained('premios');
            $table->string('descricao')->nullable();
            $table->string('tipo');
            $table->float('montante')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
