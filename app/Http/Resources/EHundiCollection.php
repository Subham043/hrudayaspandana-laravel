<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EHundiCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ehundi_id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'state' => $this->state,
            'amount' => $this->amount,
            'trust' => $this->trust,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
