<?php

namespace App\Http\Controllers;

use App\Models\Clientes;


use Illuminate\Http\Request;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $cadastro = Clientes::all();
//
        //$cadastro->nome = $request->nome;
        //$cadastro->email = $request->email;
        //$cadastro->msg = $request->msg;
        //
        //$cadastro->save();
        //dd($cadastro);
        return view('form', ['cliente'=>$cadastro]);

        

    }
}