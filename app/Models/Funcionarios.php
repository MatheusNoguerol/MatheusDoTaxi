<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Funcionarios extends Model
{
    
    protected $fillable=[
        'idfuncionarios',
        'ID',
        'NOME',
        'CPF',
        'DTNASCIMENTO',
        'EMAIL',
        'TELEFONE',
        'SEXO',
        'CEP',
        'LOGRADOURO',
        'NUMERO',
        'COMPLEMENTO',
        'UF',
        'MUNICIPIO',
        'BAIRRO',
        'GRAUPARENTESCO',
        'NOME1',
        'TELEFONE1',
        'NOME2',
        'TELEFONE2',
        'OBS',
        'CODFUNCIONARIO'
    ];
}