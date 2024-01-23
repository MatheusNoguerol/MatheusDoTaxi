<?php

namespace App\Http\Controllers\AreaSecuritaria;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


use App\Http\Controllers\Controller; //usar isso para poder implementar pastas no controller

use App\Models\Clientes;
use App\Models\InfoFiClientes;
use App\Models\DadosVeiculares;
use App\Models\AnexosClientes;
use App\Models\Seguradoras;
use App\Models\User;
use DateTime;

class CadastrarSeguradoController extends Controller
{
    public function allSeguradoras(){
        $query = Seguradoras::all();

        return $query;
    }

}
