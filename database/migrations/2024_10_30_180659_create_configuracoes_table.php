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
        Schema::create('configuracoes', function (Blueprint $table) {
            $table->id();
            $table->integer('empresa_id');
            $table->decimal('valor_taxa', 7, 2);
            $table->integer('expectativa_operacoes');
            $table->integer('qtd_taxas_bonificadas');
            $table->date('taxa_garantida_ate');
            $table->boolean('modulo_locacao');
            $table->boolean('modulo_vendas');
            $table->boolean('modulo_pagamento_contas');
            $table->boolean('modulo_debito_por_baixa');
            $table->boolean('modulo_nota_fiscal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracoes');
    }
};
