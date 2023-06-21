<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DadosContratuais extends Model
{
    
    protected $fillable=[
        'ID',
        'DTADMISSAO',
        'CARGO',
        'TIPOCONTRATO',
        'COMISSAOFIXA',
        'CTPS',
        'PISPASEP',
        'PASSAGEM',
        'CODFUNCIONARIO',
    ];
}

