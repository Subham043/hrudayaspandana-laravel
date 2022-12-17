<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionCollection extends JsonResource
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
            'subscription_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'ebook' => $this->ebook,
            'event' => $this->event,
            'newsletter' => $this->newsletter,
            'blog' => $this->blog,
            'crossword' => $this->crossword,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
