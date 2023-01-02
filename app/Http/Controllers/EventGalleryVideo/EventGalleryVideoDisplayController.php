<?php

namespace App\Http\Controllers\EventGalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Models\Event;
use App\Http\Resources\GalleryVideoCollection;

class EventGalleryVideoDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_video_display($event_id, $id){
        $event = Event::findOrFail($event_id);
        $gallery_video = GalleryVideo::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Event Gallery Video received successfully',
            'data' => GalleryVideoCollection::make($gallery_video),
        ], 201);
    }
}
