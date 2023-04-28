<?php

namespace App\Http\Controllers\EventGalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Models\Event;
use App\Http\Resources\GalleryVideoCollection;
use Stevebauman\Purify\Facades\Purify;
use Uuid;

class EventGalleryVideoEditController extends Controller
{

    public function gallery_video_edit(Request $request, $event_id, $id){
        $event = Event::findOrFail($event_id);
        $gallery_video = GalleryVideo::findOrFail($id);

        $request->validate([
            'video' => 'required|string',
        ]);

        $gallery_video->update(Purify::clean([
            'video' => $request->video,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Event Gallery Video updated successfully',
            'data' => GalleryVideoCollection::make($gallery_video),
        ], 200);
    }
}
