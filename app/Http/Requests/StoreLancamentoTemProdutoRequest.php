<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLancamentoTemProdutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'quantidade'        => 'required',
            'preco_unitario'    => 'required',
        ];
    }
}
