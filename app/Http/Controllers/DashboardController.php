<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Clientes;
use App\Models\InfoFi;
use App\Models\Contadore;
use App\Models\User;

class DashboardController extends Controller
{
    
    public function save_cliente(Request $request){

        $contadorId = Contadore::select('contadorInfoFi')->orderBy('contadorInfoFi', 'desc')->first();
        
        $contadorFinal = $contadorId['contadorInfoFi'] + 1;

        $updateContadores = Contadore::where('contadorInfoFi', '=', $contadorId['contadorInfoFi'])->update([
            'contadorInfoFi' => $contadorId['contadorInfoFi'] + 1
        ]);

        $cliente = new Clientes;
        $cliente->id = $contadorFinal;
        $cliente->nome = $request->nome;
        $cliente->email = $request->email;
        $cliente->msg = $request->msg;
        $cliente->placa = $request->placa;
        $cliente->telefone = $request->telefone;
        $cliente->tipoCliente = $request->tipoCliente;
        $cliente->aniversario = $request->nascimento;
        $cliente->vencApolice = $request->vencApolice;
        $cliente->cpfCnpj = $request->cpfCnpj;
        $cliente->cep = $request->cep;
        $cliente->logradouro = $request->logradouro;
        $cliente->numero = $request->numero;
        $cliente->complemento = $request->complemento;
        $cliente->uf = $request->uf;
        $cliente->municipio = $request->municipio;
        $cliente->bairro = $request->bairro;
        $cliente->atualSeguradora = $request->atualSeguradora;
        $cliente->comissao = $request->comissao;
        $cliente->responsavel = $request->responsavel;
        

        $cliente->save();

        $infoFi = new InfoFi;
        $infoFi->id = $contadorFinal;
        $infoFi->nobanco = $request->nmrbanco;
        $infoFi->banco = $request->banco;
        $infoFi->agencia = $request->agencia;
        $infoFi->conta = $request->conta;
        $infoFi->titular = $request->titular;
        $infoFi->cpfTitular = $request->cpfTitular;
        $infoFi->tipo = $request->tipoConta;

        $infoFi->save();

        return [$cliente, $infoFi, $updateContadores];
    }    

    public function all_clientes(){
        $dados = Clientes::all();

        return $dados;
    }

    public function exclui_cliente(Request $request){
        $query = Clientes::where('id', '=', $request->id)->delete();

        $queryDeletaInfofi = InfoFi::where('titular', '=', $request->nome)->delete();

        return [$query, $queryDeletaInfofi];
    }

    public function edita_cliente(Request $request){
        
        $query = Clientes::where('id', '=', $request->id)->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'msg' => $request->msg,
            'placa' => $request->placa,
            'telefone' => $request->telefone,
            'tipoCliente' => $request->tipoCliente,
            'aniversario' => $request->aniversario,
            'vencApolice' => $request->vencApolice,
            'cpfCnpj' => $request->cpfCnpj,
            'cep' => $request->cep,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'uf' => $request->uf,
            'municipio' => $request->municipio,
            'bairro' => $request->bairro,
            'atualSeguradora' => $request->atualSeguradora,
            'comissao' => $request->comissao,
            
        ]);

        $InfoFi = InfoFi::where('id', '=', $request->id)->update([
            'nobanco' => $request->nmrbanco,
            'agencia' => $request->agencia,
            'conta' => $request->conta,
            'banco'  => $request->banco,
            'titular'  => $request->titular,
            'cpfTitular' => $request->cpfTitular,
            'tipo' => $request->tipoConta,
            
        ]);

        return [$query, $InfoFi];
    }

    public function info_fin_cli(Request $request){
        $dados = InfoFi::where('id', '=', $request->id)->get();

        return $dados;
    }
}
