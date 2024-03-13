<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome'          => 'required',
            'valor_venda'   => 'required',
            'categoria_id'  => 'nullable|exists:categorias,id'
        ];
    }
}
