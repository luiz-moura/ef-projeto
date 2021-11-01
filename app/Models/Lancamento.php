<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lancamento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'contexto_id',
        'empresa_id',
        'operacao',
        'data_operacao'
    ];

    public function lancamentoTemProdutos()
    {
        return $this->hasMany(LancamentoTemProduto::class, 'lancamento_id', 'id');
    }
}
