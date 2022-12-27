<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaCollection extends JsonResource
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
            'id' => $this->id,
            'type' => $this->type,
            'media' => $this->type==1 ? asset('storage/upload/media/'.$this->media) : $this->media,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
