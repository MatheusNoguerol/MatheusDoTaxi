<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormController;

use App\Http\Controllers\StudentController;

use App\Http\Controllers\QuemSomosController;

use App\Http\Controllers\MultimidiaController;

use App\Http\Controllers\LocalizaçãoController;

use App\Http\Controllers\FaleConoscoController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\DashboardController;

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

Route::post('save_student','StudentController@save_student');

Route::get('welcome1', 'HomeController@show')->name('welcome1');



################ AUTH ###############

Route::post('/auth', 'UserController@auth')->name('auth.user');

Route::post('seguros', 'UserController@seguros')->name('seguros');

Route::post('estoque', 'UserController@estoque')->name('estoque');

Route::post('cadastro-cliente', 'UserController@cadastroCliente')->name('cadastro-cliente');

Route::post('cadastro-funcionario', 'UserController@cadastroFuncionario')->name('cadastro-funcionario');

Route::post('adicionar-produto', 'UserController@adicionarProduto')->name('adicionar-produto');

Route::post('consultar-cadastro', 'UserController@consultarCadastro')->name('consultar-cadastro');


//Route::get('/dashboard', 'DashboardController@save_cliente')->name('dashboard');

Route::post('save_cliente', 'DashboardController@save_cliente')->name('save-cliente');

Route::get('all_clientes', 'DashboardController@all_clientes')->name('all-clientes');

Route::post('exclui-cliente', 'DashboardController@exclui_cliente')->name('exclui-cliente');

Route::post('edita-cliente', 'DashboardController@edita_cliente')->name('edita-cliente');

Route::post('info-fin-cli', 'DashboardController@info_fin_cli')->name('info-fin-cli');




##################### FUNCIONARIOS ##########################

Route::post('salva-funcionario', 'FuncionariosController@salvaFuncionario')->name('salva-funcionario');

Route::post('salva-info-add-funcionarios', 'FuncionariosController@salvaInfoAddFuncionarios')->name('salva-info-add-funcionarios');

Route::get('all-funcionarios', 'FuncionariosController@allFuncionarios')->name('all-funcionario');

Route::post('seleciona-dados-extras-funcionarios', 'FuncionariosController@selecionaDadosExtras')->name('seleciona-dados-extras-funcionarios');

Route::post('edita-funcionario', 'FuncionariosController@editaFuncionario')->name('edita-funcionario');

