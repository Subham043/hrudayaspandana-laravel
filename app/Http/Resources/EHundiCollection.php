<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EHundiCollection extends JsonResource
{
    public function getTrust(){
        $trust = [
            1 => "Sai Mayee Trust",
            2 => "Sri Sai Meru Mathi Trust",
        ];
        return $trust[$this->trust];
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'state' => $this->state,
            'amount' => $this->amount,
            'trust' => $this->trust,
            'trust_name' => $this->getTrust(),
            'pan' => $this->pan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
