<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Clientes;
use App\Models\InfoFi;
use App\Models\Contadore;
use App\Models\User;
use App\Models\Funcionarios;

class FuncionariosController extends Controller

{
    public function salvaFuncionario(Request $request){

        $funcionario = new Funcionarios;
        $funcionario->NOME = $request->nome;
        $funcionario->CPF = $request->cpf;
        $funcionario->DTNASCIMENTO = $request->nascimento;
        $funcionario->EMAIL = $request->email;
        $funcionario->TELEFONE = $request->telefone;
        $funcionario->SEXO = $request->sexo;
        $funcionario->CEP = $request->cep;
        $funcionario->LOGRADOURO = $request->logradouro;
        $funcionario->NUMERO = $request->numero;
        $funcionario->COMPLEMENTO = $request->complemento;
        $funcionario->UF = $request->uf;
        $funcionario->MUNICIPIO = $request->municipio;
        $funcionario->BAIRRO = $request->bairro;
        $funcionario->GRAUPARENTESCO1 = $request->parentescoContatoAdicional1;
        $funcionario->NOME1 = $request->nomeContatoAdicional1;
        $funcionario->TELEFONE1 = $request->telefoneContatoAdicional1;
        $funcionario->GRAUPARENTESCO2 = $request->parentescoContatoAdicional2;
        $funcionario->NOME2 = $request->nomeContatoAdicional2;
        $funcionario->TELEFONE2 = $request->telefoneContatoAdicional2;
        $funcionario->OBS = $request->obs;
        $funcionario->CODFUNCIONARIO = $request->obs;
        $funcionario->DTADMISSAO = $request->dtAdmissao;
        $funcionario->CARGO = $request->cargo;
        $funcionario->TIPOCONTRATO = $request->tipoContrato;
        $funcionario->COMISSAOFIXA = $request->comissaoFixa;
        $funcionario->CTPS = $request->ctps;
        $funcionario->PISPASEP = $request->pispasep;
        $funcionario->PASSAGEM = $request->passagem;
        

        $funcionario->save();

        return $funcionario;
    }
}