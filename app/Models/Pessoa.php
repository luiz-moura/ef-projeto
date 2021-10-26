<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'email',
        'telefone',
        'rua',
        'numero',
        'bairro',
        'complemento',
        'cidade',
        'estado',
        'cep',
        'observacoes'
    ];
}
