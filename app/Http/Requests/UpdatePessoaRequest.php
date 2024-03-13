<?php

namespace App\Http\Requests;

use App\Rules\CpfCnpj;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePessoaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome'                  => 'required',
            'cpf_cnpj'              => [
                'nullable',
                New CpfCnpj($this->pessoa->id),
            ],
            'inscricao_estadual'    => [
                'nullable',
                Rule::unique('pessoas')->ignore($this->pessoa->id)
            ],
        ];
    }
}
