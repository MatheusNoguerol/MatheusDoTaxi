<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfoFiClientes extends Model
{
    
    protected $fillable=[
        'ID',
        'NOBANCO',
        'BANCO',
        'AGENCIA',
        'CONTA',
        'TITULAR',
        'CPFTITULAR',
        'TIPOCONTA',
        'CODCLIENTE'
    ];
}