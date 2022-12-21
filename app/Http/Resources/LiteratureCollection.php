<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LiteratureCollection extends JsonResource
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
            'literature_id' => $this->id,
            'name' => $this->name,
            'image' => asset('storage/upload/literature/'.$this->image),
            'is_pdf' => $this->is_pdf,
            'file' => $this->is_pdf ? asset('storage/upload/literature/'.$this->file) : $this->file,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
