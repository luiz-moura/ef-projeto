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

    public function produtos()
    {
        return $this
            ->belongsToMany(Produto::class, 'lancamento_tem_produtos')
            ->using(LancamentoTemProduto::class)
            ->withPivot('id', 'quantidade', 'preco_unitario');
    }

    public function empresa()
    {
        return $this->hasOne(Pessoa::class, 'id', 'empresa_id');
    }

    public function getOperacaoFormatadoAttribute()
    {
        return match ($this->operacao) {
            'v' => 'Venda',
            's' => 'Saída',
            'e' => 'Entrada',
            default => null,
        };
    }
}
