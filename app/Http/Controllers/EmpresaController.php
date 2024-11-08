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

        // //Validação dos dados 
        // $validateData = $request->validate([
        //     'email' => 'required|email|unique:administradores,email',
        //     'documento' => 'required|string|unique:empresas,documento',
        // ]);

        try {
            DB::beginTransaction();

            //Salvar dados na tabela empresas
            $empresaData = $request->input('empresaData');
            $empresa = Empresa::create($empresaData);

            //Dados para a tabela administradores
            $adminData = $request->input('adminData');
            $adminData['empresa_id'] = $empresa->id;
            $adminData['senha'] = bcrypt($adminData['senha']);
            Administrador::create($adminData);

            //Dados para a tabela configuracoes
            $configuracaoData = $request->input('configuracaoData');

            if (isset($configuracaoData['valor_taxa'])) {
                $configuracaoData['valor_taxa'] = str_replace(',', '.', $configuracaoData['valor_taxa']);
            }

            $configuracaoData['empresa_id'] = $empresa->id;
            Configuracao::create($configuracaoData);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Empresa cadastrada com sucesso!'], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => 'Erro ao cadastrar', 'error' => $e->getMessage()], 500);
        }
    }
}
