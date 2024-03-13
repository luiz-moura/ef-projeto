<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Empresa extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'nome'          => $this->nome,
            'cpf_cnpj'      => $this->cpf_cnpj,
            'cidade'        => $this->cidade,
            'estado'        => $this->estado,
            'contexto_id'   => $this->contextos()->where('tipo', 'e')->first()->id,
        ];
    }
}
