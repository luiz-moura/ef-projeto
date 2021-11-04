<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPUnit\Framework\matches;

class LancamentoTemProduto extends Pivot
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lancamento_tem_produtos';

    protected $fillable = [
        'produto_id',
        'lancamento_id',
        'quantidade',
        'preco_unitario'
    ];

    public function produto()
    {
        return $this->hasOne(Produto::class, 'id', 'produto_id');
    }

    public function lancamento()
    {
        return $this->hasOne(Lancamento::class, 'id', 'lancamento_id');
    }
}
