<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome'                  => 'required',
            'cpf_cnpj'              => 'nullable|unique:pessoas,cpf_cnpj',
            'inscricao_estadual'    => 'nullable|unique:pessoas,inscricao_estadual'
        ];
    }
}
