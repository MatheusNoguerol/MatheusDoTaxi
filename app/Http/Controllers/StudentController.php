<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Clientes;

class StudentController extends Controller
{
    public function save_student(){
        $cliente = new Clientes;
        $cliente->nome = request()->nome;
        $cliente->email = request()->email;
        $cliente->msg = request()->msg;

        $cliente->save();

        return $cliente;
    }
}