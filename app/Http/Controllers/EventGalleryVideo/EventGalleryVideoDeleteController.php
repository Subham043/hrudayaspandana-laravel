<?php

namespace App\Http\Controllers\EventGalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Models\Event;
use App\Http\Resources\GalleryVideoCollection;

class EventGalleryVideoDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_video_delete($event_id, $id){
        $event = Event::findOrFail($event_id);
        $gallery_video = GalleryVideo::findOrFail($id);

        $gallery_video->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Event Gallery Video deleted successfully',
            'data' => GalleryVideoCollection::make($gallery_video),
        ], 200);
    }
}
