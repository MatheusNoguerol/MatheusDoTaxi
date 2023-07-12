<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Clientes;
use App\Models\InfoFiFuncionarios;
use App\Models\Contadore;
use App\Models\User;
use App\Models\Funcionarios;
use App\Models\DadosContratuais;

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
        $funcionario->TEMCONTATOADC = $request->temContatoAdicional;
        $funcionario->GRAUPARENTESCO1 = $request->parentescoContatoAdicional1;
        $funcionario->NOME1 = $request->nomeContatoAdicional1;
        $funcionario->TELEFONE1 = $request->telefoneContatoAdicional1;
        $funcionario->GRAUPARENTESCO2 = $request->parentescoContatoAdicional2;
        $funcionario->NOME2 = $request->nomeContatoAdicional2;
        $funcionario->TELEFONE2 = $request->telefoneContatoAdicional2;
        $funcionario->OBS = $request->obs;
        
        $funcionario->save();

        if($request->dtAdmissao == null && $request->cargo == null && $request->tipoContrato == null && $request->comissaoFixa == null && $request->ctps == null && $request->pispasep == null && $request->passagem == null && $request->nmrbanco == null && $request->banco == null && $request->agencia == null && $request->conta == null && $request->titular == null && $request->cpfTitular == null && $request->tipoConta == null && $request->formasPix == null && $request->chave == null){
            
            return $funcionario ;
            
        }
        else if($request->nmrbanco == null && $request->banco == null && $request->agencia == null && $request->conta == null && $request->titular == null && $request->cpfTitular == null && $request->tipoConta == null && $request->formasPix == null && $request->chave == null){
            
            $dadosContratuais = new DadosContratuais;

            $dadosContratuais->DTADMISSAO = $request->dtAdmissao;
            $dadosContratuais->CARGO = $request->cargo;
            $dadosContratuais->TIPOCONTRATO = $request->tipoContrato;        
            $dadosContratuais->COMISSAOFIXA = $request->comissaoFixa;
            $dadosContratuais->CTPS = $request->ctps;
            $dadosContratuais->PISPASEP = $request->pispasep;
            $dadosContratuais->PASSAGEM = $request->passagem;
            $dadosContratuais->CODFUNCIONARIO = $funcionario['id'];
            
            $dadosContratuais->save();

            return [$funcionario ,$dadosContratuais];

        }else if($request->dtAdmissao == null && $request->cargo == null && $request->tipoContrato == null && $request->comissaoFixa == null && $request->ctps == null && $request->pispasep == null && $request->passagem == null){

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
            $dadosFinanceiros->CODFUNCIONARIO = $funcionario['id'];

            $dadosFinanceiros->save();

            return [$funcionario , $dadosFinanceiros];

        }else{

            $dadosContratuais = new DadosContratuais;

            $dadosContratuais->DTADMISSAO = $request->dtAdmissao;
            $dadosContratuais->CARGO = $request->cargo;
            $dadosContratuais->TIPOCONTRATO = $request->tipoContrato;        
            $dadosContratuais->COMISSAOFIXA = $request->comissaoFixa;
            $dadosContratuais->CTPS = $request->ctps;
            $dadosContratuais->PISPASEP = $request->pispasep;
            $dadosContratuais->PASSAGEM = $request->passagem;
            $dadosContratuais->CODFUNCIONARIO = $funcionario['id'];
            
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
            $dadosFinanceiros->CODFUNCIONARIO = $funcionario['id'];

            $dadosFinanceiros->save();

            return [$funcionario ,$dadosContratuais, $dadosFinanceiros];

        }
    }

    public function allFuncionarios(){ 
        $query = Funcionarios::all();

        return $query;
    }

    public function selecionaDadosExtras(Request $request){ 

        $query = DB::table('funcionarios')->where('funcionarios.ID', '=', $request->id)
        ->join('dados_contratuais', 'funcionarios.ID', '=', 'dados_contratuais.CODFUNCIONARIO')
        ->join('info_fi_funcionarios', 'funcionarios.ID', '=', 'info_fi_funcionarios.CODFUNCIONARIO')
        ->select('dados_contratuais.*', 'info_fi_funcionarios.*')
        ->get();

        return $query;
    }

    public function editaFuncionario(Request $request){ 
        
        $updateFuncionarios = Funcionarios::where('ID', '=', $request->id)->update([
            'NOME' => $request->nome ,
            'CPF' => $request->cpf ,
            'DTNASCIMENTO' => $request->nascimento ,
            'EMAIL' => $request->email ,
            'TELEFONE' => $request->telefone ,
            'SEXO' => $request->sexo ,
            'CEP' => $request->cep ,
            'LOGRADOURO' => $request->logradouro ,
            'NUMERO' => $request->numero ,
            'COMPLEMENTO' => $request->complemento ,
            'UF' => $request->uf ,
            'MUNICIPIO' => $request->municipio ,
            'BAIRRO' => $request->bairro ,
            'GRAUPARENTESCO1' => $request->parentescoContatoAdicional1 ,
            'NOME1' => $request->nomeContatoAdicional1 ,
            'TELEFONE1' => $request->telefoneContatoAdicional1 ,
            'GRAUPARENTESCO2' => $request->parentescoContatoAdicional2 ,
            'NOME2' => $request->nomeContatoAdicional2 ,
            'TELEFONE2' => $request->telefoneContatoAdicional2 ,
            'OBS' => $request->obs 
        ]);
        
        $existeCodDc = DadosContratuais::where('CODFUNCIONARIO', '=', $request->id)->get();
        $existeCodInfoFi = InfoFiFuncionarios::where('CODFUNCIONARIO', '=', $request->id)->get();
        
        if(count($existeCodDc) == 0 && count($existeCodInfoFi) == 0){
            if($request->nmrbanco == null && $request->banco == null && $request->agencia == null && $request->conta == null && $request->titular == null && $request->cpfTitular == null && $request->tipoConta == null && $request->formasPix == null && $request->chave == null && $request->dtAdmissao == null && $request->cargo == null && $request->tipoContrato == null && $request->comissaoFixa == null && $request->ctps == null && $request->pispasep == null && $request->passagem == null){
                
                return $updateFuncionarios;

            }else if($request->dtAdmissao == null && $request->cargo == null && $request->tipoContrato == null && $request->comissaoFixa == null && $request->ctps == null && $request->pispasep == null && $request->passagem == null){
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
                $dadosFinanceiros->CODFUNCIONARIO = $request->id;

                $dadosFinanceiros->save();

                return [$updateFuncionarios, $dadosFinanceiros];
            }else if($request->nmrbanco == null && $request->banco == null && $request->agencia == null && $request->conta == null && $request->titular == null && $request->cpfTitular == null && $request->tipoConta == null &&   $request->formasPix == null && $request->chave == null){
                $dadosContratuais = new DadosContratuais;

                $dadosContratuais->DTADMISSAO = $request->dtAdmissao;
                $dadosContratuais->CARGO = $request->cargo;
                $dadosContratuais->TIPOCONTRATO = $request->tipoContrato;
                $dadosContratuais->COMISSAOFIXA = $request->comissaoFixa;
                $dadosContratuais->CTPS = $request->ctps;
                $dadosContratuais->PISPASEP = $request->pispasep;
                $dadosContratuais->PASSAGEM = $request->passagem;
                $dadosContratuais->CODFUNCIONARIO = $request->id;
                
                $dadosContratuais->save();
                
                return [$updateFuncionarios, $dadosContratuais];
            }else{
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
                $dadosFinanceiros->CODFUNCIONARIO = $request->id;

                $dadosFinanceiros->save();
                
                $dadosContratuais = new DadosContratuais;

                $dadosContratuais->DTADMISSAO = $request->dtAdmissao;
                $dadosContratuais->CARGO = $request->cargo;
                $dadosContratuais->TIPOCONTRATO = $request->tipoContrato;
                $dadosContratuais->COMISSAOFIXA = $request->comissaoFixa;
                $dadosContratuais->CTPS = $request->ctps;
                $dadosContratuais->PISPASEP = $request->pispasep;
                $dadosContratuais->PASSAGEM = $request->passagem;
                $dadosContratuais->CODFUNCIONARIO = $request->id;
                
                $dadosContratuais->save();

                return [$updateFuncionarios, $dadosFinanceiros, $dadosContratuais];
            }

        }else if(count($existeCodDc) == 0){

            $dadosContratuais = new DadosContratuais;
            $dadosContratuais->DTADMISSAO = $request->dtAdmissao;
            $dadosContratuais->CARGO = $request->cargo;
            $dadosContratuais->TIPOCONTRATO = $request->tipoContrato;        
            $dadosContratuais->COMISSAOFIXA = $request->comissaoFixa;
            $dadosContratuais->CTPS = $request->ctps;
            $dadosContratuais->PISPASEP = $request->pispasep;
            $dadosContratuais->PASSAGEM = $request->passagem;
            $dadosContratuais->CODFUNCIONARIO = $request->id;
            
            $dadosContratuais->save();

            $updateInfoFiFuncionarios = InfoFiFuncionarios::where('CODFUNCIONARIO', '=', $request->id)->update([
                'NOBANCO' => $request->nmrbanco ,
                'BANCO' => $request->banco ,
                'AGENCIA' => $request->agencia ,
                'CONTA' => $request->conta ,
                'TITULAR' => $request->titular ,
                'CPFTITULAR' => $request->cpfTitular ,
                'TIPO' => $request->tipoConta ,
                'TIPOCHAVE' => $request->formasPix ,
                'CHAVEPIX' => $request->chave 
            ]);

            return [$updateFuncionarios, $dadosContratuais, $updateInfoFiFuncionarios];
        }else if(count($existeCodInfoFi) == 0){

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
            $dadosFinanceiros->CODFUNCIONARIO = $request->id;

            $dadosFinanceiros->save();

            $updateDadosContratuais = DadosContratuais::where('CODFUNCIONARIO', '=', $request->id)->update([
                'DTADMISSAO' => $request->dtAdmissao ,
                'CARGO' => $request->cargo ,
                'TIPOCONTRATO' => $request->tipoContrato ,
                'COMISSAOFIXA' => $request->comissaoFixa ,
                'CTPS' => $request->ctps ,
                'PISPASEP' => $request->pispasep ,
                'PASSAGEM' => $request->passagem 
            ]); 

            return [$updateFuncionarios, $updateDadosContratuais, $dadosFinanceiros];
        }else{

            $updateDadosContratuais = DadosContratuais::where('CODFUNCIONARIO', '=', $request->id)->update([
                'DTADMISSAO' => $request->dtAdmissao ,
                'CARGO' => $request->cargo ,
                'TIPOCONTRATO' => $request->tipoContrato ,
                'COMISSAOFIXA' => $request->comissaoFixa ,
                'CTPS' => $request->ctps ,
                'PISPASEP' => $request->pispasep ,
                'PASSAGEM' => $request->passagem 
            ]); 
            
            $updateInfoFiFuncionarios = InfoFiFuncionarios::where('CODFUNCIONARIO', '=', $request->id)->update([
                'NOBANCO' => $request->nmrbanco ,
                'BANCO' => $request->banco ,
                'AGENCIA' => $request->agencia ,
                'CONTA' => $request->conta ,
                'TITULAR' => $request->titular ,
                'CPFTITULAR' => $request->cpfTitular ,
                'TIPO' => $request->tipoConta ,
                'TIPOCHAVE' => $request->formasPix ,
                'CHAVEPIX' => $request->chave 
            ]);
    
            return [$updateFuncionarios, $updateDadosContratuais, $updateInfoFiFuncionarios];
        }
    
    }

    public function deletaFuncionario(Request $request){ 

        $queryFuncionarios = Funcionarios::where('ID', '=', $request->id)->delete();
        
        $temDadosContratuais = DadosContratuais::where('CODFUNCIONARIO', '=', $request->id)->get(); 
        $temInfoFi = InfoFiFuncionarios::where('CODFUNCIONARIO', '=', $request->id)->get();
        
        if(count($temDadosContratuais) == 0 && count($temInfoFi) == 0){
            
            return $queryFuncionarios;

        }else if(count($temDadosContratuais) == 0 && count($temInfoFi) <> 0){
            
            $queryInfoFi = InfoFiFuncionarios::where('CODFUNCIONARIO', '=', $request->id)->delete();

            return [$queryFuncionarios, $queryInfoFi];

        }else if(count($temDadosContratuais) <> 0 && count($temInfoFi) == 0){

            $queryDadosContratuais = DadosContratuais::where('CODFUNCIONARIO', '=', $request->id)->delete();

            return [$queryFuncionarios, $queryDadosContratuais];

        }else{

            $queryInfoFi = InfoFiFuncionarios::where('CODFUNCIONARIO', '=', $request->id)->delete();
            
            $queryDadosContratuais = DadosContratuais::where('CODFUNCIONARIO', '=', $request->id)->delete();

            return [$queryFuncionarios, $queryInfoFi, $queryDadosContratuais];

        }
    }
}
