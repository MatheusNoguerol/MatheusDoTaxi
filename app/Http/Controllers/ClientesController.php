<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Clientes;
use App\Models\InfoFiClientes;
use App\Models\DadosVeiculares;
use App\Models\AnexosClientes;
use App\Models\User;

class ClientesController extends Controller
{
    public function allClientes(){
    
        $query = Clientes::all();
    
        return $query;
    }
    
    public function salvaCliente(Request $request){
        // dd($request);
        $cliente = new Clientes;
        
        $cliente->NOME = $request['dados'][0]['nome'];
        $cliente->CPFCNPJ = $request['dados'][0]['cpfCnpj'];
        $cliente->NASCIMENTO = $request['dados'][0]['nascimento'];
        $cliente->RATR = $request['dados'][0]['ratr'];
        $cliente->EMAIL = $request['dados'][0]['email'];
        $cliente->DTCADASTRO = $request['dados'][0]['dtCadastro'];
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

        if($request['dados'][0]['placa'] == null && $request['dados'][0]['permissao'] == null && $request['dados'][0]['chassi'] == null && $request['dados'][0]['renavan'] == null && $request['dados'][0]['anoModelo'] == null && $request['dados'][0]['anoFab'] == null && $request['dados'][0]['combustivel'] == null && $request['dados'][0]['possuiGnv'] == null && $request['dados'][0]['gnv'] == null && $request['dados'][0]['categoria'] == null && $request['dados'][0]['ultimoLa'] == null &&$request['dados'][0]['possuiAlienacao'] == null && $request['dados'][0]['bancoAlienado'] == null && $request['dados'][0]['vencApolice'] == null && $request['dados'][0]['atualSeguradora'] == null && $request['dados'][0]['nmrbanco'] == null && $request['dados'][0]['banco'] == null && $request['dados'][0]['agencia'] == null && $request['dados'][0]['conta'] == null && $request['dados'][0]['titular'] == null && $request['dados'][0]['cpfTitular'] == null && $request['dados'][0]['tipoConta'] == null && $request['dados'][0]['tipoChave'] == null && $request['dados'][0]['chave'] == null){
            
            return $cliente;

        }else if($request['dados'][0]['placa'] == null && $request['dados'][0]['permissao'] == null && $request['dados'][0]['chassi'] == null && $request['dados'][0]['renavan'] == null && $request['dados'][0]['anoModelo'] == null && $request['dados'][0]['anoFab'] == null && $request['dados'][0]['combustivel'] == null && $request['dados'][0]['possuiGnv'] == null && $request['dados'][0]['gnv'] == null && $request['dados'][0]['categoria'] == null && $request['dados'][0]['ultimoLa'] == null &&$request['dados'][0]['possuiAlienacao'] == null && $request['dados'][0]['bancoAlienado'] == null && $request['dados'][0]['vencApolice'] == null && $request['dados'][0]['atualSeguradora'] == null){
            
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
            $dadosVeiculares->PERMISSAO = $request['dados'][0]['permissao'];
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
            $dadosVeiculares->PERMISSAO = $request['dados'][0]['permissao'];
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

    public function excluiCliente(Request $request){
        $queryClientes = Clientes::where('CODCLIENTE', '=', $request->codigo)->delete();
        
        $temDadosVeiculares = DadosVeiculares::where('CODCLIENTE', '=', $request->codigo)->get();

        $temInfoFiClientes = InfoFiClientes::where('CODCLIENTE', '=', $request->codigo)->get();

        if(count($temDadosVeiculares) == 0 && count($temInfoFiClientes) == 0){
            return $queryClientes;
        }else if(count($temDadosVeiculares) == 0){
            $queryInfoFiClientes = InfoFiClientes::where('CODCLIENTE', '=', $request->codigo)->delete();

            return [$queryClientes, $queryInfoFiClientes];
        }else if(count($temInfoFiClientes) == 0){
            $queryDadosVeiculares = DadosVeiculares::where('CODCLIENTE', '=', $request->codigo)->delete();

            return [$queryClientes, $queryDadosVeiculares];
        }else{
            $queryDadosVeiculares = DadosVeiculares::where('CODCLIENTE', '=', $request->codigo)->delete();

            $queryInfoFiClientes = InfoFiClientes::where('CODCLIENTE', '=', $request->codigo)->delete();

            return [$queryClientes, $queryDadosVeiculares, $queryInfoFiClientes];
        }
    }

    public function editaCliente(Request $request){
        
        $updateCliente = Clientes::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->update([
            'NOME' => $request['dados'][0]['nome'],
            'CPFCNPJ' => $request['dados'][0]['cpfCnpj'],
            'NASCIMENTO' => $request['dados'][0]['nascimento'] ,
            'EMAIL' => $request['dados'][0]['email'],
            'DTCADASTRO' => $request['dados'][0]['dtCadastro'],
            'RATR' => $request['dados'][0]['ratr'],
            'TELEFONE' => $request['dados'][0]['telefone'],
            'TIPOCLIENTE' => $request['dados'][0]['tipoCliente'],
            'CEP' => $request['dados'][0]['cep'],
            'LOGRADOURO' => $request['dados'][0]['logradouro'],
            'NUMERO' => $request['dados'][0]['numero'],
            'COMPLEMENTO' => $request['dados'][0]['complemento'],
            'UF' => $request['dados'][0]['uf'],
            'MUNICIPIO' => $request['dados'][0]['municipio'],
            'BAIRRO' => $request['dados'][0]['bairro'],
            'MSG' => $request['dados'][0]['msg'],
            'RESPONSAVEL' => $request['dados'][0]['user'] 
        ]);
        
        $existeCodDv = DadosVeiculares::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->get();
        
        $existeCodInfoFi = InfoFiClientes::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->get();
        
        if(count($existeCodDv) == 0 && count($existeCodInfoFi) == 0){

            if($request['dados'][0]['placa'] == null && $request['dados'][0]['permissao'] == null && $request['dados'][0]['chassi'] == null && $request['dados'][0]['renavan'] == null && $request['dados'][0]['anoModelo'] == null && $request['dados'][0]['anoFab'] == null && $request['dados'][0]['combustivel'] == null && $request['dados'][0]['possuiGnv'] == null && $request['dados'][0]['gnv'] == null && $request['dados'][0]['categoria'] == null && $request['dados'][0]['ultimoLa'] == null && $request['dados'][0]['possuiAlienacao'] == null && $request['dados'][0]['bancoAlienado'] == null && $request['dados'][0]['vencApolice'] == null && $request['dados'][0]['atualSeguradora'] == null && $request['dados'][0]['nmrbanco'] == null && $request['dados'][0]['banco'] == null && $request['dados'][0]['agencia'] == null && $request['dados'][0]['conta'] == null && $request['dados'][0]['titular'] == null && $request['dados'][0]['cpfTitular'] == null && $request['dados'][0]['tipoConta'] == null && $request['dados'][0]['tipoChave'] == null && $request['dados'][0]['chave'] == null){
                
                return $updateCliente;

            }else if($request['dados'][0]['placa'] == null && $request['dados'][0]['permissao'] == null  && $request['dados'][0]['chassi'] == null && $request['dados'][0]['renavan'] == null && $request['dados'][0]['anoModelo'] == null && $request['dados'][0]['anoFab'] == null && $request['dados'][0]['combustivel'] == null && $request['dados'][0]['possuiGnv'] == null && $request['dados'][0]['gnv'] == null && $request['dados'][0]['categoria'] == null && $request['dados'][0]['ultimoLa'] == null && $request['dados'][0]['possuiAlienacao'] == null && $request['dados'][0]['bancoAlienado'] == null && $request['dados'][0]['vencApolice'] == null && $request['dados'][0]['atualSeguradora'] == null){
                
                $dadosFinanceiros = new InfoFiClientes;

                $dadosFinanceiros->CODCLIENTE = $request['dados'][0]['codCliente'];
                $dadosFinanceiros->NOBANCO = $request['dados'][0]['nmrbanco'];
                $dadosFinanceiros->BANCO = $request['dados'][0]['banco'];
                $dadosFinanceiros->AGENCIA = $request['dados'][0]['agencia'];
                $dadosFinanceiros->CONTA = $request['dados'][0]['conta'];
                $dadosFinanceiros->TITULAR = $request['dados'][0]['titular'];
                $dadosFinanceiros->CPFTITULAR = $request['dados'][0]['cpfTitular'];
                $dadosFinanceiros->TIPOCONTA = $request['dados'][0]['tipoConta'];
                $dadosFinanceiros->TIPOCHAVE = $request['dados'][0]['tipoChave'];
                $dadosFinanceiros->CHAVE = $request['dados'][0]['chave'];
                

                $dadosFinanceiros->save();

                return [$updateCliente, $dadosFinanceiros];
            }else if($request['dados'][0]['nmrbanco'] == null && $request['dados'][0]['banco'] == null && $request['dados'][0]['agencia'] == null && $request['dados'][0]['conta'] == null && $request['dados'][0]['titular'] == null && $request['dados'][0]['cpfTitular'] == null && $request['dados'][0]['tipoConta'] == null && $request['dados'][0]['tipoChave'] == null && $request['dados'][0]['chave'] == null){
                
                $dadosVeiculares = new DadosVeiculares;

                $dadosVeiculares->CODCLIENTE = $request['dados'][0]['codCliente'];
                $dadosVeiculares->PLACA = $request['dados'][0]['placa'];
                $dadosVeiculares->PERMISSAO = $request['dados'][0]['permissao'];
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
                
                return [$updateCliente, $dadosVeiculares];
            }else{
                $dadosFinanceiros = new InfoFiClientes;
                

                $dadosFinanceiros->CODCLIENTE = $request['dados'][0]['codCliente'];
                $dadosFinanceiros->NOBANCO = $request['dados'][0]['nmrbanco'];
                $dadosFinanceiros->BANCO = $request['dados'][0]['banco'];
                $dadosFinanceiros->AGENCIA = $request['dados'][0]['agencia'];
                $dadosFinanceiros->CONTA = $request['dados'][0]['conta'];
                $dadosFinanceiros->TITULAR = $request['dados'][0]['titular'];
                $dadosFinanceiros->CPFTITULAR = $request['dados'][0]['cpfTitular'];
                $dadosFinanceiros->TIPOCONTA = $request['dados'][0]['tipoConta'];
                $dadosFinanceiros->TIPOCHAVE = $request['dados'][0]['tipoChave'];
                $dadosFinanceiros->CHAVE = $request['dados'][0]['chave'];
                

                $dadosFinanceiros->save();


                $dadosVeiculares = new DadosVeiculares;

                $dadosVeiculares->CODCLIENTE = $request['dados'][0]['codCliente'];
                $dadosVeiculares->PLACA = $request['dados'][0]['placa'];
                $dadosVeiculares->PERMISSAO = $request['dados'][0]['permissao'];
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

                return [$updateCliente, $dadosFinanceiros, $dadosVeiculares];
            }

        }else if(count($existeCodDv) == 0){

            $dadosVeiculares = new DadosVeiculares;

            $dadosVeiculares->CODCLIENTE = $request['dados'][0]['codCliente'];
            $dadosVeiculares->PLACA = $request['dados'][0]['placa'];
            $dadosVeiculares->PERMISSAO = $request['dados'][0]['permissao'];
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

            $updateInfoFiClientes = InfoFiClientes::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->update([
                'NOBANCO' => $request['dados'][0]['nmrbanco'],
                'BANCO' => $request['dados'][0]['banco'],
                'AGENCIA' => $request['dados'][0]['agencia'],
                'CONTA' => $request['dados'][0]['conta'],
                'TITULAR' => $request['dados'][0]['titular'],
                'CPFTITULAR' => $request['dados'][0]['cpfTitular'],
                'TIPOCONTA' => $request['dados'][0]['tipoConta'],
                'TIPOCHAVE' => $request['dados'][0]['tipoChave'],
                'CHAVE' => $request['dados'][0]['chave'] 
            ]);

            return [$updateCliente, $dadosVeiculares, $updateInfoFiClientes];
        }else if(count($existeCodInfoFi) == 0){

            $dadosFinanceiros = new InfoFiClientes;
                

            $dadosFinanceiros->CODCLIENTE = $request['dados'][0]['codCliente'];
            $dadosFinanceiros->NOBANCO = $request['dados'][0]['nmrbanco'];
            $dadosFinanceiros->BANCO = $request['dados'][0]['banco'];
            $dadosFinanceiros->AGENCIA = $request['dados'][0]['agencia'];
            $dadosFinanceiros->CONTA = $request['dados'][0]['conta'];
            $dadosFinanceiros->TITULAR = $request['dados'][0]['titular'];
            $dadosFinanceiros->CPFTITULAR = $request['dados'][0]['cpfTitular'];
            $dadosFinanceiros->TIPOCONTA = $request['dados'][0]['tipoConta'];
            $dadosFinanceiros->TIPOCHAVE = $request['dados'][0]['tipoChave'];
            $dadosFinanceiros->CHAVE = $request['dados'][0]['chave'];
            

            $dadosFinanceiros->save();

            $updateDadosVeiculares = DadosVeiculares::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->update([
                'PLACA' => $request['dados'][0]['placa'],
                'PERMISSAO' => $request['dados'][0]['permissao'],
                'CHASSI' => $request['dados'][0]['chassi'],
                'RENAVAN' => $request['dados'][0]['renavan'],
                'ANOMODELO' => $request['dados'][0]['anoModelo'],
                'ANOFAB' => $request['dados'][0]['anoFab'],
                'COMBUSTIVEL' => $request['dados'][0]['combustivel'],
                'TEMGAS' => $request['dados'][0]['possuiGnv'],
                'CILINDRO' => $request['dados'][0]['gnv'],
                'CATEGORIA' => $request['dados'][0]['categoria'],
                'ULTIMOLA' => $request['dados'][0]['ultimoLa'],
                'TEMALIENACAO' => $request['dados'][0]['possuiAlienacao'],
                'BANCOALIENADO' => $request['dados'][0]['bancoAlienado'],
                'VENCAPOLICE' => $request['dados'][0]['vencApolice'],
                'ATUALSEGURADORA' => $request['dados'][0]['atualSeguradora'],
            ]); 

            return [$updateCliente, $updateDadosVeiculares, $dadosFinanceiros];
        }else{

            $updateDadosVeiculares = DadosVeiculares::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->update([
                'PLACA' => $request['dados'][0]['placa'],
                'PERMISSAO' => $request['dados'][0]['permissao'],
                'CHASSI' => $request['dados'][0]['chassi'],
                'RENAVAN' => $request['dados'][0]['renavan'],
                'ANOMODELO' => $request['dados'][0]['anoModelo'],
                'ANOFAB' => $request['dados'][0]['anoFab'],
                'COMBUSTIVEL' => $request['dados'][0]['combustivel'],
                'TEMGAS' => $request['dados'][0]['possuiGnv'],
                'CILINDRO' => $request['dados'][0]['gnv'],
                'CATEGORIA' => $request['dados'][0]['categoria'],
                'ULTIMOLA' => $request['dados'][0]['ultimoLa'],
                'TEMALIENACAO' => $request['dados'][0]['possuiAlienacao'],
                'BANCOALIENADO' => $request['dados'][0]['bancoAlienado'],
                'VENCAPOLICE' => $request['dados'][0]['vencApolice'],
                'ATUALSEGURADORA' => $request['dados'][0]['atualSeguradora'],
            ]);  
            
            $updateInfoFiClientes = InfoFiClientes::where('CODCLIENTE', '=', $request['dados'][0]['codCliente'])->update([
                'NOBANCO' => $request['dados'][0]['nmrbanco'],
                'BANCO' => $request['dados'][0]['banco'],
                'AGENCIA' => $request['dados'][0]['agencia'],
                'CONTA' => $request['dados'][0]['conta'],
                'TITULAR' => $request['dados'][0]['titular'],
                'CPFTITULAR' => $request['dados'][0]['cpfTitular'],
                'TIPOCONTA' => $request['dados'][0]['tipoConta'],
                'TIPOCHAVE' => $request['dados'][0]['tipoChave'],
                'CHAVE' => $request['dados'][0]['chave'] 
            ]);
    
            return [$updateCliente, $updateDadosVeiculares, $updateInfoFiClientes];
        }
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

    public function upLoadCliente(Request $request){ 
        $name = 'C' . $request->cod . $request->file('file')->getClientOriginalName();
        $extensao = $request->file('file')->getClientOriginalExtension();

        $request->file('file')->storeAs('public/images/', $name);

        $query = new AnexosClientes;

        $query->CODCLIENTE = $request->cod;
        $query->CAMINHO = $name;
        $query->EXTENSAO = $extensao;
        $query->TIPODOCUMENTO = $request->tipoDoc;

        $query->save();
        return $query;
    
    }

    public function selecionaAnexoCliente(Request $request){ 
        
        $query = AnexosClientes::where('CODCLIENTE', '=', $request->codCliente)->get();

        return $query;
    
    }

    public function deletaAnexoCliente(Request $request){ 
        
        if(Storage::exists('public/images/' . $request->caminho)){
            $query = AnexosClientes::where('CODCLIENTE', '=', $request->codCliente)->where('CAMINHO','=', $request->caminho)->where('TIPODOCUMENTO','=', $request->tipoDocumento)->delete();
            Storage::delete('public/images/' . $request->caminho);
            return $query;
        }else{
            return ['error' => 1, 'msg' => 'O arquivo não existe na aplicação.'];
        }
        
    
    }

    public function buscaCliente(Request $request){ 
        $query = Clientes::where('CODCLIENTE', '=', $request->busca)->orWhere('NOME', '=', $request->busca)->orWhere('CPFCNPJ', '=', $request->busca)->get();
        
        if(count($query) == 0){
            return ['error' => '1' , 'msg' => 'Cliente não encontrado na base de dados.'];
        }else{
            return $query;
        }
    }
}
