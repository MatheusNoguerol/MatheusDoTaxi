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
        
        // chart-type-client
        $clientType = DB::table('clientes')
        ->select('TIPOCLIENTE', DB::raw('count(TIPOCLIENTE) as qtd'))
        ->groupBy('TIPOCLIENTE')
        ->orderBy('qtd', 'desc')
        ->get();

        // birthChart
        $allClientes = Clientes::all();
        
        $dtHoje = new DateTime();

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
        
        // chart-category

        $allCategory = DadosVeiculares::select('CATEGORIA')->get();

        
        $arrayCategory = array();

        for($g = 0 ; $g < count($allCategory); $g++){
            $category = $allCategory[$g]['CATEGORIA'];

            if($category == 'taxi'){
                array_push($arrayCategory, 'Táxi');
            }else if($category == 'particular'){
                array_push($arrayCategory, 'Particular');
            }else{
                array_push($arrayCategory, 'Sem categoria');
            }
        }

        $contagem = array_count_values($arrayCategory);
        $carCategory = array();
        foreach($contagem as $key=>$value){
            $carCategory[] = ['TIPO' => $key, 'qtd' => $value];
        }

        // chart-documentation-aliened
        

        $documentationAliened = DB::table('dados_veiculares')
        ->select('TEMALIENACAO', DB::raw('count(TEMALIENACAO) as qtd'))
        ->groupBy('TEMALIENACAO')
        ->orderBy('qtd', 'desc')
        ->get();

        // chart-vehicle

        $allVeiculos = DadosVeiculares::select('ANOFAB')->get();

        $arrayVehicle = array();
        
        $ano = date('Y');

        for($k = 0 ;$k < count($allVeiculos) ; $k++){
            $anoFab = $allVeiculos[$k]['ANOFAB'];

            if($anoFab == null){
                array_push($arrayVehicle, 'Sem Data');
            }else{
                if($anoFab == $ano - 10){
                    array_push($arrayVehicle, 'Ultimo Ano');
                }else if($anoFab == $ano - 5){
                    array_push($arrayVehicle, '5 anos');
                }else if($anoFab == $ano){
                    array_push($arrayVehicle, '0Km');
                }else{
                    array_push($arrayVehicle, '10 anos');
                }
            }

        }
        
        $contagemVeiculo = array_count_values($arrayVehicle);
        $vehicleDate = array();
        foreach($contagemVeiculo as $key=>$value){
            $vehicleDate[] = ['TIPO' => $key, 'qtd' => $value];
        }

        return ['chartClientType' => $clientType, 'birthChart' => $arrayCliente, 'carCategory' => $carCategory, 'documentationAliened' => $documentationAliened, 'vehicleDate' => $vehicleDate];
    }

    public function infoChartClientType(Request $request){
        $dados = $request;

        $query = Clientes::select(
            //client table
        'clientes.CODCLIENTE',
        'clientes.NOME',
        'clientes.CPFCNPJ',
        'clientes.NASCIMENTO',
        'clientes.RATR',
        'clientes.EMAIL',
        'clientes.TELEFONE',
        'clientes.TIPOCLIENTE',
        'clientes.CEP',
        'clientes.LOGRADOURO',
        'clientes.NUMERO',
        'clientes.COMPLEMENTO',
        'clientes.UF',
        'clientes.MUNICIPIO',
        'clientes.BAIRRO',
        'clientes.MSG',
        'clientes.DTCADASTRO',
        'clientes.RESPONSAVEL',
            //vehicle data table
        'dados_veiculares.PLACA',
        'dados_veiculares.CHASSI',
        'dados_veiculares.RENAVAN',
        'dados_veiculares.ANOMODELO',
        'dados_veiculares.ANOFAB',
        'dados_veiculares.PERMISSAO',
        'dados_veiculares.COMBUSTIVEL',
        'dados_veiculares.TEMGAS',
        'dados_veiculares.CILINDRO',
        'dados_veiculares.CATEGORIA',
        'dados_veiculares.ULTIMOLA',
        'dados_veiculares.TEMALIENACAO',
        'dados_veiculares.BANCOALIENADO',
        'dados_veiculares.VENCAPOLICE',
        'dados_veiculares.ATUALSEGURADORA',
            //finance data table
        'info_fi_clientes.NOBANCO',
        'info_fi_clientes.BANCO',
        'info_fi_clientes.AGENCIA',
        'info_fi_clientes.CONTA',
        'info_fi_clientes.TITULAR',
        'info_fi_clientes.CPFTITULAR',
        'info_fi_clientes.TIPOCONTA',
        'info_fi_clientes.TIPOCHAVE',
        'info_fi_clientes.CHAVE',

        )->where('clientes.TIPOCLIENTE', '=', $dados->name)->leftJoin('dados_veiculares', 'dados_veiculares.CODCLIENTE', '=', 'clientes.CODCLIENTE')->leftJoin('info_fi_clientes', 'info_fi_clientes.CODCLIENTE', '=', 'clientes.CODCLIENTE')->get();

        return $query;
    }

    public function infoBirthChart(Request $request){
        $dados = $request;
        
        $callbackSearch = function ($query) use ($dados){
            if ($dados->name == 'Sem Data')
            {
                $query->whereNull('clientes.NASCIMENTO');
            }

            if ($dados->name == '0-20')
            {
                $query->whereBetween('clientes.NASCIMENTO', [date('2004-m-d'), date('Y-m-d')]);
            }

            if ($dados->name == '21-65')
            {
                $query->whereBetween('clientes.NASCIMENTO', [date('1959-m-d'), date('Y-m-d')]);
            }

            if ($dados->name == '65+')
            {
                $query->whereBetween('clientes.NASCIMENTO', [date('1934-m-d'), date('Y-m-d')]);
            }
        };

        $query = Clientes::select(
            //client table
        'clientes.CODCLIENTE',
        'clientes.NOME',
        'clientes.CPFCNPJ',
        'clientes.NASCIMENTO',
        'clientes.RATR',
        'clientes.EMAIL',
        'clientes.TELEFONE',
        'clientes.TIPOCLIENTE',
        'clientes.CEP',
        'clientes.LOGRADOURO',
        'clientes.NUMERO',
        'clientes.COMPLEMENTO',
        'clientes.UF',
        'clientes.MUNICIPIO',
        'clientes.BAIRRO',
        'clientes.MSG',
        'clientes.DTCADASTRO',
        'clientes.RESPONSAVEL',
            //vehicle data table
        'dados_veiculares.PLACA',
        'dados_veiculares.CHASSI',
        'dados_veiculares.RENAVAN',
        'dados_veiculares.ANOMODELO',
        'dados_veiculares.ANOFAB',
        'dados_veiculares.PERMISSAO',
        'dados_veiculares.COMBUSTIVEL',
        'dados_veiculares.TEMGAS',
        'dados_veiculares.CILINDRO',
        'dados_veiculares.CATEGORIA',
        'dados_veiculares.ULTIMOLA',
        'dados_veiculares.TEMALIENACAO',
        'dados_veiculares.BANCOALIENADO',
        'dados_veiculares.VENCAPOLICE',
        'dados_veiculares.ATUALSEGURADORA',
            //finance data table
        'info_fi_clientes.NOBANCO',
        'info_fi_clientes.BANCO',
        'info_fi_clientes.AGENCIA',
        'info_fi_clientes.CONTA',
        'info_fi_clientes.TITULAR',
        'info_fi_clientes.CPFTITULAR',
        'info_fi_clientes.TIPOCONTA',
        'info_fi_clientes.TIPOCHAVE',
        'info_fi_clientes.CHAVE',

        )
        ->where($callbackSearch)
        ->leftJoin('dados_veiculares', 'dados_veiculares.CODCLIENTE', '=', 'clientes.CODCLIENTE')
        ->leftJoin('info_fi_clientes', 'info_fi_clientes.CODCLIENTE', '=', 'clientes.CODCLIENTE')
        ->get();

        return $query;
    }

    public function infoChartCarCategory(Request $request){
        $dados = $request;

        if($dados->name == 'Táxi'){
            $categoria = 'taxi';
        }else if($dados->name == 'Particular'){
            $categoria = 'particular';
        }else{
            $categoria = null;
        }

        $query = Clientes::select(
            //client table
        'clientes.CODCLIENTE',
        'clientes.NOME',
        'clientes.CPFCNPJ',
        'clientes.NASCIMENTO',
        'clientes.RATR',
        'clientes.EMAIL',
        'clientes.TELEFONE',
        'clientes.TIPOCLIENTE',
        'clientes.CEP',
        'clientes.LOGRADOURO',
        'clientes.NUMERO',
        'clientes.COMPLEMENTO',
        'clientes.UF',
        'clientes.MUNICIPIO',
        'clientes.BAIRRO',
        'clientes.MSG',
        'clientes.DTCADASTRO',
        'clientes.RESPONSAVEL',
            //vehicle data table
        'dados_veiculares.PLACA',
        'dados_veiculares.CHASSI',
        'dados_veiculares.RENAVAN',
        'dados_veiculares.ANOMODELO',
        'dados_veiculares.ANOFAB',
        'dados_veiculares.PERMISSAO',
        'dados_veiculares.COMBUSTIVEL',
        'dados_veiculares.TEMGAS',
        'dados_veiculares.CILINDRO',
        'dados_veiculares.CATEGORIA',
        'dados_veiculares.ULTIMOLA',
        'dados_veiculares.TEMALIENACAO',
        'dados_veiculares.BANCOALIENADO',
        'dados_veiculares.VENCAPOLICE',
        'dados_veiculares.ATUALSEGURADORA',
            //finance data table
        'info_fi_clientes.NOBANCO',
        'info_fi_clientes.BANCO',
        'info_fi_clientes.AGENCIA',
        'info_fi_clientes.CONTA',
        'info_fi_clientes.TITULAR',
        'info_fi_clientes.CPFTITULAR',
        'info_fi_clientes.TIPOCONTA',
        'info_fi_clientes.TIPOCHAVE',
        'info_fi_clientes.CHAVE',

        )
        ->where('CATEGORIA', '=', $categoria)
        ->leftJoin('dados_veiculares', 'dados_veiculares.CODCLIENTE', '=', 'clientes.CODCLIENTE')
        ->leftJoin('info_fi_clientes', 'info_fi_clientes.CODCLIENTE', '=', 'clientes.CODCLIENTE')
        ->get();

        return $query;
    }

    public function infoChartDocumentationAliened(Request $request){
        $dados = $request;


        if($dados->name == 'Alienado'){
            $alienado = 1;
        }else if($dados->name == 'Não alienado'){
            $alienado = 0;
        }

        $query = Clientes::select(
            //client table
        'clientes.CODCLIENTE',
        'clientes.NOME',
        'clientes.CPFCNPJ',
        'clientes.NASCIMENTO',
        'clientes.RATR',
        'clientes.EMAIL',
        'clientes.TELEFONE',
        'clientes.TIPOCLIENTE',
        'clientes.CEP',
        'clientes.LOGRADOURO',
        'clientes.NUMERO',
        'clientes.COMPLEMENTO',
        'clientes.UF',
        'clientes.MUNICIPIO',
        'clientes.BAIRRO',
        'clientes.MSG',
        'clientes.DTCADASTRO',
        'clientes.RESPONSAVEL',
            //vehicle data table
        'dados_veiculares.PLACA',
        'dados_veiculares.CHASSI',
        'dados_veiculares.RENAVAN',
        'dados_veiculares.ANOMODELO',
        'dados_veiculares.ANOFAB',
        'dados_veiculares.PERMISSAO',
        'dados_veiculares.COMBUSTIVEL',
        'dados_veiculares.TEMGAS',
        'dados_veiculares.CILINDRO',
        'dados_veiculares.CATEGORIA',
        'dados_veiculares.ULTIMOLA',
        'dados_veiculares.TEMALIENACAO',
        'dados_veiculares.BANCOALIENADO',
        'dados_veiculares.VENCAPOLICE',
        'dados_veiculares.ATUALSEGURADORA',
            //finance data table
        'info_fi_clientes.NOBANCO',
        'info_fi_clientes.BANCO',
        'info_fi_clientes.AGENCIA',
        'info_fi_clientes.CONTA',
        'info_fi_clientes.TITULAR',
        'info_fi_clientes.CPFTITULAR',
        'info_fi_clientes.TIPOCONTA',
        'info_fi_clientes.TIPOCHAVE',
        'info_fi_clientes.CHAVE',

        )
        ->where('TEMALIENACAO', '=', $alienado)
        ->leftJoin('dados_veiculares', 'dados_veiculares.CODCLIENTE', '=', 'clientes.CODCLIENTE')
        ->leftJoin('info_fi_clientes', 'info_fi_clientes.CODCLIENTE', '=', 'clientes.CODCLIENTE')
        ->get();

        return $query;
    }

    public function infoChartVehicleDate(Request $request){
        $dados = $request;

        // dd($dados);
        if($dados->name == '10 anos'){
            $tempo = 10;
        }else if($dados->name == '5 anos'){
            $tempo = 5;
        }else if($dados->name == '0Km'){
            $tempo = 0;
        }else{
            $tempo = null;
        }

        $anoAtual = date('Y');

        $diferenca = $anoAtual - $tempo;

        $query = Clientes::select(
            //client table
        'clientes.CODCLIENTE',
        'clientes.NOME',
        'clientes.CPFCNPJ',
        'clientes.NASCIMENTO',
        'clientes.RATR',
        'clientes.EMAIL',
        'clientes.TELEFONE',
        'clientes.TIPOCLIENTE',
        'clientes.CEP',
        'clientes.LOGRADOURO',
        'clientes.NUMERO',
        'clientes.COMPLEMENTO',
        'clientes.UF',
        'clientes.MUNICIPIO',
        'clientes.BAIRRO',
        'clientes.MSG',
        'clientes.DTCADASTRO',
        'clientes.RESPONSAVEL',
            //vehicle data table
        'dados_veiculares.PLACA',
        'dados_veiculares.CHASSI',
        'dados_veiculares.RENAVAN',
        'dados_veiculares.ANOMODELO',
        'dados_veiculares.ANOFAB',
        'dados_veiculares.PERMISSAO',
        'dados_veiculares.COMBUSTIVEL',
        'dados_veiculares.TEMGAS',
        'dados_veiculares.CILINDRO',
        'dados_veiculares.CATEGORIA',
        'dados_veiculares.ULTIMOLA',
        'dados_veiculares.TEMALIENACAO',
        'dados_veiculares.BANCOALIENADO',
        'dados_veiculares.VENCAPOLICE',
        'dados_veiculares.ATUALSEGURADORA',
            //finance data table
        'info_fi_clientes.NOBANCO',
        'info_fi_clientes.BANCO',
        'info_fi_clientes.AGENCIA',
        'info_fi_clientes.CONTA',
        'info_fi_clientes.TITULAR',
        'info_fi_clientes.CPFTITULAR',
        'info_fi_clientes.TIPOCONTA',
        'info_fi_clientes.TIPOCHAVE',
        'info_fi_clientes.CHAVE',

        )
        ->where('ANOFAB', '=', $diferenca)
        ->leftJoin('dados_veiculares', 'dados_veiculares.CODCLIENTE', '=', 'clientes.CODCLIENTE')
        ->leftJoin('info_fi_clientes', 'info_fi_clientes.CODCLIENTE', '=', 'clientes.CODCLIENTE')
        ->get();

        return $query;
    }
}
