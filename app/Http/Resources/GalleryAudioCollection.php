<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryAudioCollection extends JsonResource
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
            'gallery_audio_id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'audio' => asset('storage/upload/gallery_audio/'.$this->audio),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
