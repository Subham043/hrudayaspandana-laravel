<?php

namespace App\Http\Controllers\EventGalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Models\Event;
use App\Http\Resources\GalleryImageCollection;

class EventGalleryImageRandomController extends Controller
{
    
    public function gallery_image_random($event_id){
        $event = Event::findOrFail($event_id);
        $gallery_image = GalleryImage::where('event_id', $event_id)->get()->random();

        return response()->json([
            'status' => 'success',
            'message' => 'Event Gallery Image received successfully',
            'data' => GalleryImageCollection::collection($gallery_image),
        ], 200);
    }
}
