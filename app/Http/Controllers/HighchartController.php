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
use DateTime;

class HighchartController extends Controller
{
    public function chargingChartsPainel(){ 
        
        $clientType = DB::table('clientes')
        ->select('TIPOCLIENTE', DB::raw('count(TIPOCLIENTE) as qtd'))
        // ->whereBetween('data', [$dtInicio, $dtFim])
        ->groupBy('TIPOCLIENTE')
        ->orderBy('qtd', 'desc')
        ->get();

        
        
        $allClientes = Clientes::all();
        
        $dtHoje = new DateTime();

        $arrayCliente = array();

        $arrayCliente = array(
            0 => array(),
            1 => array(),
            2 => array(),
            3 => array(),
        );


        for($k = 0 ;$k < count($allClientes) ; $k++){
            $dtNascimento = $allClientes[$k]['NASCIMENTO'];

            if($dtNascimento == null){
                array_push($arrayCliente[0], ['TIPO' => 'Sem Data']);
            }else{
                $dtNascimentoObj = new DateTime($dtNascimento);

                $idade = $dtNascimentoObj->diff($dtHoje);

                if($idade->y <= 20){
                    array_push($arrayCliente[1], ['TIPO' => 'Adolescente']);
                }else if($idade->y <= 65){
                    array_push($arrayCliente[2], ['TIPO' => 'Adulto']);
                }else{
                    array_push($arrayCliente[3], ['TIPO' => 'Idoso']);
                }
            }
        }
        
        
        // $birthChart = DB::table('clientes')
        // ->select('NASCIMENTO', DB::raw('count(TIPOCLIENTE) as qtd'))
        // // ->whereBetween('data', [$dtInicio, $dtFim])
        // ->groupBy('TIPOCLIENTE')
        // ->orderBy('qtd', 'desc')
        // ->get();

        return ['chartClientType' => $clientType, 'birthChart' => $arrayCliente];
    }

    public function infoChartClientType(Request $request){
        $dados = $request;

        $query = Clientes::where('clientes.TIPOCLIENTE', '=', $dados->name)->leftJoin('dados_veiculares', 'dados_veiculares.CODCLIENTE', '=', 'clientes.CODCLIENTE')->leftJoin()->get();

        return $query;
    }
}
