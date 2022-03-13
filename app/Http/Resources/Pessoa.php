<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pessoa extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
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
