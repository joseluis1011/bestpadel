<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrosResource extends JsonResource
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
            "user_id" => new UserResource($this->user),
            "id" => $this->id,
            "pista" => $this->pista,
            "dia" => $this->dia,
            "mes" => $this->mes,
            "hora" => $this->hora
        ];
    }
}
