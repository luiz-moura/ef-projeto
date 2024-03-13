<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Venda extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id
        ];
    }
}
