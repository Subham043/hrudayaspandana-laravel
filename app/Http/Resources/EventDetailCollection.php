<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\GalleryImageCollection;
use App\Http\Resources\GalleryVideoCollection;

class EventDetailCollection extends JsonResource
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
            'name' => $this->name,
            'sdate' => $this->sdate,
            'edate' => $this->edate,
            'stime' => $this->stime,
            'etime' => $this->etime,
            'description1' => $this->description1,
            'description2' => $this->description2,
            'description3' => $this->description3,
            'category' => $this->category,
            'status' => $this->status,
            'image' => asset('storage/upload/event/'.$this->image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'event_gallery_images' => GalleryImageCollection::collection($this->EventGalleryImage),
            'event_gallery_videos' => GalleryVideoCollection::collection($this->EventGalleryVideo),
        ];
    }
}
