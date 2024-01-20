<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clientes extends Model
{

    protected $connection = 'mysql';

    protected $table = 'clientes';

    public $incrementing = true;

    public $timestamps = true;
    
    protected $fillable=[
        'CODCLIENTE',
        'NOME',
        'CPFCNPJ',
        'NASCIMENTO',
        'RATR',
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


  
  
  
  
  
  
  
  
  
  
  
  
  
  
  