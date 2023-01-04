<?php

namespace App\Http\Controllers\EventGalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Models\Event;
use App\Http\Resources\GalleryImageCollection;

class EventGalleryImageDisplayController extends Controller
{
    
    public function gallery_image_display($event_id, $id){
        $event = Event::findOrFail($event_id);
        $gallery_image = GalleryImage::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Event Gallery Image received successfully',
            'data' => GalleryImageCollection::make($gallery_image),
        ], 201);
    }
}
