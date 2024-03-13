<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Concerns\Filterable;
use Carbon\Carbon;

class Lancamento extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

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
            ->withPivot('id', 'quantidade', 'preco_unitario')
            ->wherePivotNull('deleted_at');
    }

    public function empresa()
    {
        return $this->hasOne(Contexto::class, 'id', 'empresa_id')->withTrashed()->withDefault();
    }

    public function contexto()
    {
        return $this->hasOne(Contexto::class, 'id', 'contexto_id')->withTrashed()->withDefault();
    }

    public function getOperacaoFormatadaAttribute()
    {
        return match ($this->operacao) {
            'v'     => 'Venda',
            's'     => 'Saída',
            'e'     => 'Entrada',
            default => 'null',
        };
    }

    public function getDataOperacaoFormatadaAttribute()
    {
        return Carbon::parse($this->data_operacao)->format('h:m - d/m/Y');
    }

    public function getContextoPessoaAttribute()
    {
        return match ($this->operacao) {
            'v'         => 'Cliente',
            's'         => 'Pessoa',
            'e'         => 'Fornecedor',
            default     => 'Pessoa',
        };
    }
}
