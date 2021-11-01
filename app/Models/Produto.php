<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'categoria_id',
        'codigo_barras',
        'nome',
        'marca',
        'ultimo_valor_custo',
        'valor_venda'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->withDefault();
    }

    public function toArray()
    {
        return [
            'id'            => $this->id,
            'nome'          => $this->nome,
            'valor_venda'   => $this->valor_venda
        ];
    }
}
