<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaleConoscoController extends Controller
{
    public function show(){
        return view('faleConosco');
    }
}