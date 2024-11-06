<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    use HasFactory;

    protected $table = 'configuracoes';

    protected $fillable = [
        'empresa_id',
        'valor_taxa',
        'expectativa_operacoes',
        'qtd_taxas_bonificadas',
        'taxa_garantida_ate',
        'modulo_locacao',
        'modulo_vendas',
        'modulo_pagamento_contas',
        'modulo_debito_por_baixa',
        'modulo_nota_fiscal',
    ];
}
