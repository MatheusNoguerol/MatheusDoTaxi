<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clientes extends Model
{
    
    protected $fillable=[
        'id',
        'nome',
        'email',
        'msg',
        'placa',
        'telefone',
        'aniversario',
        'vencApolice',
        'cpfCnpj',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'uf',
        'municipio',
        'bairro',
        'atualSeguradora',
        'comissao',
        'responsavel'
    ];
}


  
  
  
  
  
  
  
  
  
  
  
  
  
  
  