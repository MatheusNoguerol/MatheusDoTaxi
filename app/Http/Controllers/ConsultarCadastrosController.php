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
        // dd($request['arrayBusca'][0]);
        // if($request['arrayBusca'][0]['tipoConsulta'] == 'cliente'){
            
        //     $callbackSearch = function ($query) use ($request){
        //         if ($request['arrayBusca'][0]['nomeConsulta'] <> null)
        //         {
        //             $query->where("clientes.NOME", "like", '%' . $request['arrayBusca'][0]['nomeConsulta']);
        //         }
                
        //         if ($request['arrayBusca'][0]['dtCadastroDe'] <> null || $request['arrayBusca'][0]['dtCadastroAte'])
        //         {
        //             $query->whereBetween('clientes.DTCADASTRO', [$request['arrayBusca'][0]['dtCadastroDe'], $request['arrayBusca'][0]['dtCadastroAte']]);
        //         }
                
        //         // if ($dados->ratrConsulta <> null)
        //         // {
        //         //     $query->where("itenspedidovenda.FILIAL", '=', $dados->filial);
        //         // }
        //         // if ($dados->cpfConsulta <> null)
        //         // {
        //         //     $query->where("itenspedidovenda.FILIAL", '=', $dados->filial);
        //         // }
        //         // if ($dados->dtNascimentoDe <> null)
        //         // {
        //         //     $query->where("itenspedidovenda.FILIAL", '=', $dados->filial);
        //         // }
        //         // if ($dados->dtNascimentoAte <> null)
        //         // {
        //         //     $query->where("itenspedidovenda.FILIAL", '=', $dados->filial);
        //         // }
        //         // if ($dados->permissaoConsulta <> null)
        //         // {
        //         //     $query->where("itenspedidovenda.FILIAL", '=', $dados->filial);
        //         // }
        //         // if ($dados->placaConsulta <> null)
        //         // {
        //         //     $query->where("itenspedidovenda.FILIAL", '=', $dados->filial);
        //         // }
        //         // if ($dados->categoriaConsulta <> null)
        //         // {
        //         //     $query->where("itenspedidovenda.FILIAL", '=', $dados->filial);
        //         // }
        //     };
            
        //     $query = Clientes::where($callbackSearch)
        //     ->get();

        //     dd($query);

        //     return $query;

        // }


        
        if($request['arrayBusca'][0]['tipoConsulta'] == 'cliente'){
            
            // dd($request);
            if($request['arrayBusca'][0]['pesquisaCliente'] == 'nome'){
                
                $query = Clientes::where('NOME', 'like', '%' . $request['arrayBusca'][0]['nomeConsulta'] . '%')->get();

                dd(count($query));

                if(count($query) == 1){
                    $dadosVeiculares = DadosVeiculares::where('CODCLIENTE', '=', $query[0]['CODCLIENTE'])->get();

                    if(count($dadosVeiculares) == 0){
                        return;
                    }
                }

                // if(count())
                
                

                if(count($dadosVeiculares) == 0){
                    return ['ref' => 1 , $query];
                }else{
                    return ['ref' => 0, $query , $dadosVeiculares];
                }
                // dd($dadosVeiculares);
            }
        }else{

        }
    }
}