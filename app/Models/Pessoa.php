<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pessoas';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'email',
        'telefone',
        'inscricao_estadual',
        'nome_fantasia',
        'razao_social',
        'rua',
        'numero',
        'bairro',
        'complemento',
        'cidade',
        'estado',
        'cep',
        'observacoes'
    ];

    public function contextos()
    {
        return $this->hasMany(Contexto::class, 'pessoa_id', 'id');
    }
}
