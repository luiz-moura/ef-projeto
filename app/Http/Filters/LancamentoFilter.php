<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class LancamentoFilter extends Filter
{
    /**
     * Filter the products by the given string.
     *
     * @param  string|null  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function period(array $period = []): Builder
    {
        if (is_null($period[0]) || is_null($period[1])) {
            return $this->builder;
        }

        return $this->builder->whereBetween('data_operacao', [$period[0], $period[1] . ' 23:59:59.999']);
    }

    public function limit(string $value = '100'): Builder
    {
        return $this->builder->limit($value);
    }

    public function sort(string $value = null): Builder
    {
        return $this->builder->orderBy(
            'data_operacao', $value ?? 'asc'
        );
    }

    public function empresa(string $value = null): Builder
    {
        if (is_null($value)) {
            return $this->builder;
        }

        return $this->builder->where(
            'empresa_id', $value ?? null
        );
    }
}
