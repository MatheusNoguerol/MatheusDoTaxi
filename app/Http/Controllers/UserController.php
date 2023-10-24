<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{

    public function auth(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return view('/dashboard');
        }else{
            return view('auth.login');//redirect()->route('/auth');
        }
    }





    ############################################################## CADASTRO ##############################################################


        public function cadastroCliente(Request $request)
        {
            return view('/cadastro/cadastroCliente');
        }

        public function cadastroFuncionario(Request $request)
        {
            return view('/cadastro/cadastroFuncionario');
        }
        
    #########################################################################################################################################





    ############################################################## ESTOQUE ##################################################################


        public function estoque(Request $request)
        {
            return view('/estoque/estoque');
            //if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            //}else{
            //    return view('auth.login');//redirect()->route('/auth');
            //}
        }
        
        public function adicionarProduto(Request $request)
        {
            return view('/estoque/adicionarProduto');
        }


    #########################################################################################################################################





    ############################################################## CONSULTAR ##################################################################


        public function consultarCadastro(Request $request)
        {
            return view('/cadastro/consultarCadastro');
            //if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            //}else{
            //    return view('auth.login');//redirect()->route('/auth');
            //}
        }


    #########################################################################################################################################





    ############################################################## SEGUROS ##################################################################
        

        public function seguros(Request $request)
        {
            return view('/seguros');
            //if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            //}else{
            //    return view('auth.login');//redirect()->route('/auth');
            //}
        }
    
        
    #########################################################################################################################################


}