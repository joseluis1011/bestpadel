<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userTorneoResource extends JsonResource
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
            "torneo_id" => new TorneoResource($this->torneos),
        ];
    }
}
