<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Clientes;
use App\Models\InfoFiFuncionarios;
use App\Models\Contadore;
use App\Models\User;
use App\Models\Funcionarios;
use App\Models\DadosContratuais;

class FuncionariosController extends Controller

{
    public function salvaFuncionario(Request $request){
        
        $contadorFunc = Contadore::select('contadorFunc')->orderBy('contadorFunc', 'desc')->get();

        $codFuncionario = $contadorFunc[0]['contadorFunc'] + 1;
        
        $updateContadorFunc = Contadore::where('contadorFunc', '=', $contadorFunc[0]['contadorFunc'])->update([
            'contadorFunc' => $codFuncionario
        ]);

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
        $funcionario->CODFUNCIONARIO = $codFuncionario;
        
        $funcionario->save();


        $dadosContratuais = new DadosContratuais;
        $dadosContratuais->DTADMISSAO = $request->dtAdmissao;
        $dadosContratuais->CARGO = $request->cargo;
        $dadosContratuais->TIPOCONTRATO = $request->tipoContrato;        
        $dadosContratuais->COMISSAOFIXA = $request->comissaoFixa;
        $dadosContratuais->CTPS = $request->ctps;
        $dadosContratuais->PISPASEP = $request->pispasep;
        $dadosContratuais->PASSAGEM = $request->passagem;
        $dadosContratuais->CODFUNCIONARIO = $codFuncionario;
        
        $dadosContratuais->save();


        
        $dadosFinanceiros = new InfoFiFuncionarios;
        $dadosFinanceiros->NOBANCO = $request->nmrbanco;
        $dadosFinanceiros->BANCO = $request->banco;
        $dadosFinanceiros->AGENCIA = $request->agencia;       
        $dadosFinanceiros->CONTA = $request->conta;
        $dadosFinanceiros->TITULAR = $request->titular;
        $dadosFinanceiros->CPFTITULAR = $request->cpfTitular;
        $dadosFinanceiros->TIPO = $request->tipoConta;
        $dadosFinanceiros->TIPOCHAVE = $request->formasPix;
        $dadosFinanceiros->CHAVEPIX = $request->chave;
        $dadosFinanceiros->CODFUNCIONARIO = $codFuncionario;

        $dadosFinanceiros->save();


        return [$funcionario, $dadosContratuais, $dadosFinanceiros];
    }

    public function allFuncionarios(){ 
        $query = Funcionarios::all();

        return $query;
    }

    public function selecionaDadosExtras(Request $request){ 
        $queryDadosContratuais = DadosContratuais::where('CODFUNCIONARIO', '=', $request->codFuncionario)->get();

        $queryInfoFiFuncionarios = InfoFiFuncionarios::where('CODFUNCIONARIO', '=', $request->codFuncionario)->get();

        return [$queryDadosContratuais, $queryInfoFiFuncionarios] ;
    }
}