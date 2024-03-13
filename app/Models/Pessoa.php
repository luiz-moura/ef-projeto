<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Pessoa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pessoas';

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

    public function scopeTipo($qb, $tipo)
    {
        return $qb->whereRelation('contextos', 'tipo', $tipo);
    }

    public function scopeCliente($qb)
    {
        return $qb->whereRelation('contextos', 'tipo', 'c');
    }

    public function contextos()
    {
        return $this->hasMany(Contexto::class, 'pessoa_id', 'id');
    }

    public function getCreatedAtFormatadaAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function getCpfCnpjFormatadoAttribute()
    {
        if (!$this->cpf_cnpj) {
            return null;
        }

        if (strlen($this->cpf_cnpj) >= 14) {
            return $this->mask($this->cpf_cnpj, '##.###.###/####-##');
        }

        return $this->mask($this->cpf_cnpj, '###.###.###-##');
    }

    public function setCpfCnpjAttribute($value)
    {
        $onlyNumber = preg_replace('/[^0-9]/', '', $value);

        if (is_null($value) or $value == '') {
            $this->attributes['cpf_cnpj'] = null;
        } else {
            $this->attributes['cpf_cnpj'] = $onlyNumber;
        }
    }

    private function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if (isset($mask[$i])) $maskared .= $mask[$i];
            }
        }

        return $maskared;
    }
}
