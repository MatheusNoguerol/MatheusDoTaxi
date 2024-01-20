<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FormController;

use App\Http\Controllers\StudentController;

use App\Http\Controllers\QuemSomosController;

use App\Http\Controllers\MultimidiaController;

use App\Http\Controllers\LocalizaçãoController;

use App\Http\Controllers\FaleConoscoController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\FuncionariosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/home');
});

Auth::routes();


############################# SITE #############################

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/quemSomos', 'QuemSomosController@show')->name('quem-somos');

Route::get('/multimidia', 'MultimidiaController@show')->name('multimidia');

Route::get('/localizacao', 'LocalizacaoController@show')->name('localizacao');

Route::get('/faleConosco', 'FaleConoscoController@show')->name('fale-conosco');


Route::get('/form', 'FormController@store')->name('form');


Route::get('welcome1', 'HomeController@show')->name('welcome1');



################ AUTH ###############

Route::post('/auth', 'UserController@auth')->name('auth.user');

Route::post('seguros', 'UserController@seguros')->name('seguros');

Route::post('estoque', 'UserController@estoque')->name('estoque');

Route::post('cadastro-cliente', 'UserController@cadastroCliente')->name('cadastro-cliente');

Route::post('cadastro-funcionario', 'UserController@cadastroFuncionario')->name('cadastro-funcionario');

Route::post('adicionar-produto', 'UserController@adicionarProduto')->name('adicionar-produto');

Route::post('consultar-cadastro', 'UserController@consultarCadastro')->name('consultar-cadastro');

Route::post('painel-cadastro', 'UserController@painelCadastro')->name('painel-cadastro');




##################### CLIENTE ##########################

Route::post('salva-cliente', 'ClientesController@salvaCliente')->name('save-cliente');

Route::get('all-clientes', 'ClientesController@allClientes')->name('all-clientes');

Route::post('exclui-cliente', 'ClientesController@excluiCliente')->name('exclui-cliente');

Route::post('edita-cliente', 'ClientesController@editaCliente')->name('edita-cliente');

Route::post('seleciona-cliente', 'ClientesController@selecionaCliente')->name('seleciona-cliente');

Route::post('storage/upload/cliente', 'ClientesController@upLoadCliente')->name('storage/upload/cliente');

Route::post('deleta-anexo-cliente', 'ClientesController@deletaAnexoCliente')->name('deleta-anexo-cliente');

Route::post('seleciona-anexos-cliente', 'ClientesController@selecionaAnexoCliente')->name('seleciona-anexos-cliente');

Route::post('busca-cliente', 'ClientesController@buscaCliente')->name('busca-cliente');








##################### FUNCIONARIOS ##########################

Route::post('salva-funcionario', 'FuncionariosController@salvaFuncionario')->name('salva-funcionario');

Route::post('salva-info-add-funcionarios', 'FuncionariosController@salvaInfoAddFuncionarios')->name('salva-info-add-funcionarios');

Route::get('all-funcionarios', 'FuncionariosController@allFuncionarios')->name('all-funcionario');

Route::post('seleciona-dados-extras-funcionarios', 'FuncionariosController@selecionaDadosExtras')->name('seleciona-dados-extras-funcionarios');

Route::post('edita-funcionario', 'FuncionariosController@editaFuncionario')->name('edita-funcionario');

Route::post('deleta-funcionario', 'FuncionariosController@deletaFuncionario')->name('deleta-funcionario');

Route::post('seleciona-anexos', 'FuncionariosController@selecionaAnexo')->name('seleciona-anexos');

Route::post('storage/upload', 'FuncionariosController@upLoad')->name('storage-upload');

Route::post('deleta-anexo', 'FuncionariosController@deletaAnexo')->name('deleta-anexo');

// Route::post('download-anexo', 'FuncionariosController@downloadAnexo')->name('download-anexo');



##################### CADASTROS ##########################

Route::post('consulta-cadastro-cliente', 'ConsultarCadastrosController@consultarCadastroCliente')->name('consulta-cadastro-cliente');









##################### CHARTS ##########################

Route::get('charging-charts-painel', 'HighchartController@chargingChartsPainel')->name('charging-charts-painel');

Route::post('info-chart-client-type', 'HighchartController@infoChartClientType')->name('info-chart-client-type');
