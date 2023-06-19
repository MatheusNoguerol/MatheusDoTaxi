<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfoFi extends Model
{
    
    protected $fillable=[
        'id',
        'nobanco',
        'banco',
        'agencia',
        'conta',
        'titular',
        'cpfTitular',
        'tipo'
    ];
}