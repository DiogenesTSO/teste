<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Configuracao;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    public function cadastrarEmpresa(Request $request) {

        $validateData = $request->validate([
            'tipo' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $empresaData = $request->only(['nome', 'documento', 'data_nascimento', 'tipo', 'telefone', 'celular', 'email', 'cep', 'rua', 'numero', 'complemento', 'bairro', 'cidade', 'estado']);
            $empresa = Empresa::create($empresaData);

            $adminData = $request->only(['nome', 'celular', 'email', 'senha']);
            $adminData['empresa_id'] = $empresa->id;
            Administrador::create($adminData);

            $configuracaoData = $request->only(['valor_taxa', 'expectativa_operacoes', 'qtd_taxas_bonificadas', 'taxa_garantida_ate', 'modulo_locacao', 'modulo_vendas', 'modulo_pagamento_contas', 'modulo_debito_por_baixa', 'modulo_nota_fiscal',]);
            $configuracaoData['empresa_id'] = $empresa->id;
            Configuracao::create($configuracaoData);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Empresa cadastrada'], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => 'Erro ao cadastrar', 'error' => $e->getMessage()], 500);
        }
    }
}
