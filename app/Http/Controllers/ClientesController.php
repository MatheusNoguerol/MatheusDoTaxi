<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Clientes;
use App\Models\InfoFiClientes;
use App\Models\DadosVeiculares;
use App\Models\User;

class ClientesController extends Controller
{
    public function all_clientes(){
    
        $query = Clientes::all();
    
        return $query;
    }
    
    public function salvaCliente(Request $request){
        $cliente = new Clientes;
        
        $cliente->NOME = $request['dados'][0]['nome'];
        $cliente->CPFCNPJ = $request['dados'][0]['cpfCnpj'];
        $cliente->NASCIMENTO = $request['dados'][0]['nascimento'];
        $cliente->EMAIL = $request['dados'][0]['email'];
        $cliente->TELEFONE = $request['dados'][0]['telefone'];
        $cliente->TIPOCLIENTE = $request['dados'][0]['tipoCliente'];
        $cliente->CEP = $request['dados'][0]['cep'];
        $cliente->LOGRADOURO = $request['dados'][0]['logradouro'];
        $cliente->NUMERO = $request['dados'][0]['numero'];
        $cliente->COMPLEMENTO = $request['dados'][0]['complemento'];
        $cliente->UF = $request['dados'][0]['uf'];
        $cliente->MUNICIPIO = $request['dados'][0]['municipio'];
        $cliente->BAIRRO = $request['dados'][0]['bairro'];
        $cliente->MSG = $request['dados'][0]['msg'];
        $cliente->RESPONSAVEL = $request['dados'][0]['user'];

        $cliente->save();

        if($request['dados'][0]['placa'] == null && $request['dados'][0]['chassi'] == null && $request['dados'][0]['renavan'] == null && $request['dados'][0]['anoModelo'] == null && $request['dados'][0]['anoFab'] == null && $request['dados'][0]['combustivel'] == null && $request['dados'][0]['possuiGnv'] == null && $request['dados'][0]['gnv'] == null && $request['dados'][0]['categoria'] == null && $request['dados'][0]['ultimoLa'] == null &&$request['dados'][0]['possuiAlienacao'] == null && $request['dados'][0]['bancoAlienado'] == null && $request['dados'][0]['vencApolice'] == null && $request['dados'][0]['atualSeguradora'] == null && $request['dados'][0]['nmrbanco'] == null && $request['dados'][0]['banco'] == null && $request['dados'][0]['agencia'] == null && $request['dados'][0]['conta'] == null && $request['dados'][0]['titular'] == null && $request['dados'][0]['cpfTitular'] == null && $request['dados'][0]['tipoConta'] == null && $request['dados'][0]['tipoChave'] == null && $request['dados'][0]['chave'] == null){
            
            return $cliente;

        }else if($request['dados'][0]['placa'] == null && $request['dados'][0]['chassi'] == null && $request['dados'][0]['renavan'] == null && $request['dados'][0]['anoModelo'] == null && $request['dados'][0]['anoFab'] == null && $request['dados'][0]['combustivel'] == null && $request['dados'][0]['possuiGnv'] == null && $request['dados'][0]['gnv'] == null && $request['dados'][0]['categoria'] == null && $request['dados'][0]['ultimoLa'] == null &&$request['dados'][0]['possuiAlienacao'] == null && $request['dados'][0]['bancoAlienado'] == null && $request['dados'][0]['vencApolice'] == null && $request['dados'][0]['atualSeguradora'] == null){
            
            $queryInfoFi = new InfoFiClientes;
        
            $queryInfoFi->CODCLIENTE = $cliente['id'];
            $queryInfoFi->NOBANCO = $request['dados'][0]['nmrbanco'];
            $queryInfoFi->BANCO = $request['dados'][0]['banco'];
            $queryInfoFi->AGENCIA = $request['dados'][0]['agencia'];
            $queryInfoFi->CONTA = $request['dados'][0]['conta'];
            $queryInfoFi->TITULAR = $request['dados'][0]['titular'];
            $queryInfoFi->CPFTITULAR = $request['dados'][0]['cpfTitular'];
            $queryInfoFi->TIPOCONTA = $request['dados'][0]['tipoConta'];
            $queryInfoFi->TIPOCHAVE = $request['dados'][0]['tipoChave'];
            $queryInfoFi->CHAVE = $request['dados'][0]['chave'];
        
            $queryInfoFi->save();
            
            return [$cliente, $queryInfoFi];

        }else if($request['dados'][0]['nmrbanco'] == null && $request['dados'][0]['banco'] == null && $request['dados'][0]['agencia'] == null && $request['dados'][0]['conta'] == null && $request['dados'][0]['titular'] == null && $request['dados'][0]['cpfTitular'] == null && $request['dados'][0]['tipoConta'] == null && $request['dados'][0]['tipoChave'] == null && $request['dados'][0]['chave'] == null){

            $dadosVeiculares = new DadosVeiculares;

            $dadosVeiculares->CODCLIENTE = $cliente['id'];
            $dadosVeiculares->PLACA = $request['dados'][0]['placa'];
            $dadosVeiculares->CHASSI = $request['dados'][0]['chassi'];
            $dadosVeiculares->RENAVAN = $request['dados'][0]['renavan'];
            $dadosVeiculares->ANOMODELO = $request['dados'][0]['anoModelo'];
            $dadosVeiculares->ANOFAB = $request['dados'][0]['anoFab'];
            $dadosVeiculares->COMBUSTIVEL = $request['dados'][0]['combustivel'];
            $dadosVeiculares->TEMGAS = $request['dados'][0]['possuiGnv'];
            $dadosVeiculares->CILINDRO = $request['dados'][0]['gnv'];
            $dadosVeiculares->CATEGORIA = $request['dados'][0]['categoria'];
            $dadosVeiculares->ULTIMOLA = $request['dados'][0]['ultimoLa'];
            $dadosVeiculares->TEMALIENACAO = $request['dados'][0]['possuiAlienacao'];
            $dadosVeiculares->BANCOALIENADO = $request['dados'][0]['bancoAlienado'];
            $dadosVeiculares->VENCAPOLICE = $request['dados'][0]['vencApolice'];
            $dadosVeiculares->ATUALSEGURADORA = $request['dados'][0]['atualSeguradora'];
            
            $dadosVeiculares->save();

            return [$cliente, $dadosVeiculares];

        }else{

            $queryInfoFi = new InfoFiClientes;
        
            $queryInfoFi->CODCLIENTE = $cliente['id'];
            $queryInfoFi->NOBANCO = $request['dados'][0]['nmrbanco'];
            $queryInfoFi->BANCO = $request['dados'][0]['banco'];
            $queryInfoFi->AGENCIA = $request['dados'][0]['agencia'];
            $queryInfoFi->CONTA = $request['dados'][0]['conta'];
            $queryInfoFi->TITULAR = $request['dados'][0]['titular'];
            $queryInfoFi->CPFTITULAR = $request['dados'][0]['cpfTitular'];
            $queryInfoFi->TIPOCONTA = $request['dados'][0]['tipoConta'];
            $queryInfoFi->TIPOCHAVE = $request['dados'][0]['tipoChave'];
            $queryInfoFi->CHAVE = $request['dados'][0]['chave'];
        
            $queryInfoFi->save();

            $dadosVeiculares = new DadosVeiculares;

            $dadosVeiculares->CODCLIENTE = $cliente['id'];
            $dadosVeiculares->PLACA = $request['dados'][0]['placa'];
            $dadosVeiculares->CHASSI = $request['dados'][0]['chassi'];
            $dadosVeiculares->RENAVAN = $request['dados'][0]['renavan'];
            $dadosVeiculares->ANOMODELO = $request['dados'][0]['anoModelo'];
            $dadosVeiculares->ANOFAB = $request['dados'][0]['anoFab'];
            $dadosVeiculares->COMBUSTIVEL = $request['dados'][0]['combustivel'];
            $dadosVeiculares->TEMGAS = $request['dados'][0]['possuiGnv'];
            $dadosVeiculares->CILINDRO = $request['dados'][0]['gnv'];
            $dadosVeiculares->CATEGORIA = $request['dados'][0]['categoria'];
            $dadosVeiculares->ULTIMOLA = $request['dados'][0]['ultimoLa'];
            $dadosVeiculares->TEMALIENACAO = $request['dados'][0]['possuiAlienacao'];
            $dadosVeiculares->BANCOALIENADO = $request['dados'][0]['bancoAlienado'];
            $dadosVeiculares->VENCAPOLICE = $request['dados'][0]['vencApolice'];
            $dadosVeiculares->ATUALSEGURADORA = $request['dados'][0]['atualSeguradora'];
            
            $dadosVeiculares->save();

            return [$cliente, $queryInfoFi, $dadosVeiculares];

        }
    }    

    public function exclui_cliente(Request $request){
        $query = Clientes::where('id', '=', $request->id)->delete();

        $queryDeletaInfofi = InfoFi::where('titular', '=', $request->nome)->delete();

        return [$query, $queryDeletaInfofi];
    }

    public function edita_cliente(Request $request){
        
        $updateCliente = Clientes::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->update([
            'NOME' => $request['dados'][0]['nome'],
            'CPFCNPJ' => $request['dados'][0]['cpfCnpj'],
            'NASCIMENTO' => $request['dados'][0]['nascimento'] ,
            'EMAIL' => $request['dados'][0]['email'],
            'TELEFONE' => $request['dados'][0]['telefone'],
            'TIPOCLIENTE' => $request['dados'][0]['tipoCliente'],
            'CEP' => $request['dados'][0]['cep'],
            'LOGRADOURO' => $request['dados'][0]['logradouro'],
            'NUMERO' => $request['dados'][0]['numero'],
            'COMPLEMENTO' => $request['dados'][0]['nascimento'],
            'UF' => $request['dados'][0]['uf'],
            'MUNICIPIO' => $request['dados'][0]['municipio'],
            'BAIRRO' => $request['dados'][0]['bairro'],
            'MSG' => $request['dados'][0]['msg'],
            'RESPONSAVEL' => $request['dados'][0]['user'] 
        ]);
        
        $existeCodDv = DadosVeiculares::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->get();
        
        $existeCodInfoFi = InfoFiClientes::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->get();
        
        if(count($existeCodDv) == 0 && count($existeCodInfoFi) == 0){
            
            if($request['dados'][0]['placa'] == null && $request['dados'][0]['chassi'] == null && $request['dados'][0]['renavan'] == null && $request['dados'][0]['anoModelo'] == null && $request['dados'][0]['anoFab'] == null && $request['dados'][0]['combustivel'] == null && $request['dados'][0]['possuiGnv'] == null && $request['dados'][0]['gnv'] == null && $request['dados'][0]['categoria'] == null && $request['dados'][0]['ultimoLa'] == null &&$request['dados'][0]['possuiAlienacao'] == null && $request['dados'][0]['bancoAlienado'] == null && $request['dados'][0]['vencApolice'] == null && $request['dados'][0]['atualSeguradora'] == null && $request['dados'][0]['nmrbanco'] == null && $request['dados'][0]['banco'] == null && $request['dados'][0]['agencia'] == null && $request['dados'][0]['conta'] == null && $request['dados'][0]['titular'] == null && $request['dados'][0]['cpfTitular'] == null && $request['dados'][0]['tipoConta'] == null && $request['dados'][0]['tipoChave'] == null && $request['dados'][0]['chave'] == null){
                
                dd('oi');
                

                
                // renavan
                // chassi
                // anoModelo
                // anoFab
                // combustivel
                // possuiGnv
                // gnv
                // possuiAlienacao
                // bancoAlienado
                // ultimoLa
                // vencApolice
                // atualSeguradora




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

    public function selecionaCliente(Request $request){
        $temDadosVeiculares = DadosVeiculares::where('CODCLIENTE', '=', $request->codigo)->get();


        $temInfoFiClientes = InfoFiClientes::where('CODCLIENTE', '=', $request->codigo)->get();
        
        if(count($temDadosVeiculares) === 0 && count($temInfoFiClientes) === 0){

            return ['error' => 1];

        }else if(count($temInfoFiClientes) === 0 && count($temDadosVeiculares) <> 0){
            $query = DB::table('clientes')->where('clientes.CODCLIENTE', '=', $request->codigo)
            ->join('dados_veiculares', 'clientes.CODCLIENTE', '=', 'dados_veiculares.CODCLIENTE')
            ->select('dados_veiculares.*')
            ->get();

            return ['success' => 2 , $query];

        }else if(count($temInfoFiClientes) <> 0 && count($temDadosVeiculares) === 0){
            $query = DB::table('clientes')->where('clientes.CODCLIENTE', '=', $request->codigo)
            ->join('info_fi_clientes', 'clientes.CODCLIENTE', '=', 'info_fi_clientes.CODCLIENTE')
            ->select('info_fi_clientes.*')
            ->get();

            return ['success' => 3 , $query];

        }else{
            $query = DB::table('clientes')->where('clientes.CODCLIENTE', '=', $request->codigo)
            ->join('dados_veiculares', 'clientes.CODCLIENTE', '=', 'dados_veiculares.CODCLIENTE')
            ->join('info_fi_clientes', 'clientes.CODCLIENTE', '=', 'info_fi_clientes.CODCLIENTE')
            ->select('dados_veiculares.*', 'info_fi_clientes.*')
            ->get();

            return ['success' => 4 , $query];
        }

    }
}
