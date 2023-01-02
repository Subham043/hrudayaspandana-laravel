<?php

namespace App\Http\Controllers\EventGalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Models\Event;
use App\Http\Resources\GalleryVideoCollection;
use Uuid;
use Auth;

class EventGalleryVideoCreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function gallery_video_create(Request $request, $event_id){
        $event = Event::findOrFail($event_id);
        $request->validate([
            'video' => 'required|string',
        ]);

        $gallery_video = GalleryVideo::create([
            'video' => $request->video,
            'category' => $event->category,
            'event_id' => $event_id,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Event Gallery Video created successfully',
            'data' => GalleryVideoCollection::make($gallery_video),
        ], 201);
    }
}
