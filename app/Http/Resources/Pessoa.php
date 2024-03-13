<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pessoa extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'nome'          => $this->nome,
            'cpf_cnpj'      => $this->cpf_cnpj,
            'cidade'        => $this->cidade,
            'estado'        => $this->estado,
            'contextos'     => $this->contextos,
        ];
    }
}
