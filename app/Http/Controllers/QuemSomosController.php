<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Form;

class QuemSomosController extends Controller
{
    public function show(){
       return view('quemSomos');
    }
}