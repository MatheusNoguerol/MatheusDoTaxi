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

class ConsultarCadastrosController extends Controller
{
    public function consultarCadastroCliente(Request $request){
        if($request['arrayBusca'][0]['tipoConsulta'] == 'cliente'){
            
            if($request['arrayBusca'][0]['pesquisaCliente'] == 'nome'){
                
                $query = Clientes::where('NOME', 'like', $request['arrayBusca'][0]['nomeConsulta'] . '%')->leftjoin('dados_veiculares', 'clientes.CODCLIENTE', 'dados_veiculares.CODCLIENTE')->leftjoin('info_fi_clientes', 'clientes.CODCLIENTE', '=', 'info_fi_clientes.CODCLIENTE')->orderBy('clientes.NOME', 'asc')->get();

                if(count($query) == 0){
                    return ['error' => 1];
                }

                return $query;

            }else if($request['arrayBusca'][0]['pesquisaCliente'] == 'ratr'){

                $query = Clientes::where('RATR', '=', $request['arrayBusca'][0]['ratrConsulta'])->leftjoin('dados_veiculares', 'clientes.CODCLIENTE', '=', 'dados_veiculares.CODCLIENTE')->get();

                if(count($query) == 0){
                    return ['error' => 1];
                }

                return $query;

            }else if($request['arrayBusca'][0]['pesquisaCliente'] == 'cpf'){

                $query = Clientes::where('CPFCNPJ', '=', $request['arrayBusca'][0]['cpfConsulta'])->leftjoin('dados_veiculares', 'clientes.CODCLIENTE', '=', 'dados_veiculares.CODCLIENTE')->get();

                if(count($query) == 0){
                    return ['error' => 1];
                }

                return $query;

            }else if($request['arrayBusca'][0]['pesquisaCliente'] == 'dtNascimento'){

                $query = Clientes::whereBetween('clientes.NASCIMENTO', [$request['arrayBusca'][0]['dtNascimentoDe'], $request['arrayBusca'][0]['dtNascimentoAte']])->leftJoin('dados_veiculares', 'clientes.CODCLIENTE', '=', 'dados_veiculares.CODCLIENTE')->orderBy('clientes.NOME', 'asc')->get();

                if(count($query) == 0){
                    return ['error' => 1];
                }
                
                return $query;
                
            }else if($request['arrayBusca'][0]['pesquisaCliente'] == 'dtCadastro'){

                $query = Clientes::whereBetween('clientes.DTCADASTRO', [$request['arrayBusca'][0]['dtCadastroDe'], $request['arrayBusca'][0]['dtCadastroAte']])->leftJoin('dados_veiculares', 'clientes.CODCLIENTE', '=', 'dados_veiculares.CODCLIENTE')->orderBy('clientes.NOME', 'asc')->get();

                if(count($query) == 0){
                    return ['error' => 1];
                }
                
                return $query;
                
            }else if($request['arrayBusca'][0]['pesquisaCliente'] == 'permissao'){

                $query = DadosVeiculares::where('PERMISSAO', '=' , $request['arrayBusca'][0]['permissaoConsulta'])->leftJoin('clientes', 'clientes.CODCLIENTE', '=', 'dados_veiculares.CODCLIENTE')->orderBy('clientes.NOME', 'asc')->get();

                if(count($query) == 0){
                    return ['error' => 1];
                }
                
                return $query;
                
            }else if($request['arrayBusca'][0]['pesquisaCliente'] == 'placa'){

                $query = DadosVeiculares::where('PLACA', '=' , $request['arrayBusca'][0]['placaConsulta'])->leftJoin('clientes', 'clientes.CODCLIENTE', '=', 'dados_veiculares.CODCLIENTE')->orderBy('clientes.NOME', 'asc')->get();

                if(count($query) == 0){
                    return ['error' => 1];
                }
                
                return $query;
                
            }else if($request['arrayBusca'][0]['pesquisaCliente'] == 'categoria'){

                $query = DadosVeiculares::where('CATEGORIA', '=' , $request['arrayBusca'][0]['categoriaConsulta'])->leftJoin('clientes', 'clientes.CODCLIENTE', '=', 'dados_veiculares.CODCLIENTE')->orderBy('clientes.NOME', 'asc')->get();

                if(count($query) == 0){
                    return ['error' => 1];
                }
                
                return $query;
                
            }
        }else{

        }
    }
}