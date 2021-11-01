<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LancamentoTemProduto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'produto_id',
        'lancamento_id',
        'quantidade',
        'preco_unitario'
    ];
}
