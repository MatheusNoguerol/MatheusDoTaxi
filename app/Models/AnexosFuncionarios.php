<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnexosFuncionarios extends Model
{
    
    protected $fillable=[
        'ID',
        'CODFUNCIONARIO',
        'TIPODOCUMENTO',
        'CAMINHO',
        'EXTENSAO',
    ];
}