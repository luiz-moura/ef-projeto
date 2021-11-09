<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contexto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['tipo', 'vigencia'];

    public function pessoa()
    {
        return $this->hasOne(Pessoa::class, 'id', 'pessoa_id');
    }

    public function pessoaTrash()
    {
        return Pessoa::withTrashed()->find($this->pessoa_id);
    }

    public function getTipoFormatadoAttribute()
    {
        return match ($this->tipo) {
            'c' => 'Cliente',
            'f' => 'Funcionario',
            'u' => 'Fornecedor',
            'e' => 'Empresa',
            default => null,
        };
    }

    public function getNomeAttribute()
    {
            return $this->pessoaTrash()?->nome;
    }
}
