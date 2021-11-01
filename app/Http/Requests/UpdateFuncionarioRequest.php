<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFuncionarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'                  => 'required',
            'cpf_cnpj'              => 'nullable|unique:pessoas,cpf_cnpj',
            'inscricao_estadual'    => 'nullable|unique:pessoas,inscricao_estadual'
        ];
    }
}
