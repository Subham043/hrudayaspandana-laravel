<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonationCollection extends JsonResource
{
    public function getTrust(){
        $trust = [
            1 => "Sai Mayee Trust",
            2 => "Sri Sai Meru Mathi Trust",
        ];
        return $trust[$this->trust];
    }
    
    public function getStatus(){
        $status = [
            0 => "Payment Pending",
            1 => "Payment Completed",
        ];
        return $status[$this->status];
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
            'pan' => $this->pan,
            'trust' => $this->trust,
            'trust_name' => $this->getTrust(),
            'status' => $this->status,
            'status_name' => $this->getStatus(),
            'receipt' => $this->receipt,
            'order_id' => $this->order_id,
            'payment_id' => $this->payment_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
