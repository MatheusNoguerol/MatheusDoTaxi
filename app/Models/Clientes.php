<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clientes extends Model
{
    
    protected $fillable=[
        'CODCLIENTE',
        'NOME',
        'CPFCNPJ',
        'NASCIMENTO',
        'EMAIL',
        'TELEFONE',
        'TIPOCLIENTE',
        'CEP',
        'LOGRADOURO',
        'NUMERO',
        'COMPLEMENTO',
        'UF',
        'MUNICIPIO',
        'BAIRRO',
        'MSG',
        'DTCADASTRO',
        'RESPONSAVEL'
    ];


   
}


  
  
  
  
  
  
  
  
  
  
  
  
  
  
  