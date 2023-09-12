<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DadosVeiculares extends Model
{
    
    protected $fillable=[
        'ID',
        'PLACA',
        'CHASSI',
        'RENAVAN',
        'ANOMODELO',
        'ANOFAB',
        'PERMISSAO',
        'COMBUSTIVEL',
        'TEMGAS',
        'CILINDRO',
        'CATEGORIA',
        'ULTIMOLA',
        'CODCLIENTE',
        'TEMALIENACAO',
        'BANCOALIENADO',
        'VENCAPOLICE',
        'ATUALSEGURADORA'
    ];
}