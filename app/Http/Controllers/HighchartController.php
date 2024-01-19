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

class HighchartController extends Controller
{
    public function chargingChartsPainel(Request $request){ 
    //    $query = Clientes::where('nota_pesquisa','=', $dados->name)
    //     ->whereBetween('data', [$dados->dtInicio == null ? date('2020-01-01 00:00:00') : $dados->dtInicio, $dados->dtFim == null ? date('Y-m-d H:i:s') : $dados->dtFim])
    //     ->orderBy('id', 'desc')
    //     ->get();

    //     return $query;
    }
}
