<?php

namespace App\Http\Controllers\GalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Http\Resources\GalleryVideoCollection;
use Stevebauman\Purify\Facades\Purify;
use Uuid;

class GalleryVideoEditController extends Controller
{

    public function gallery_video_edit(Request $request, $id){
        $gallery_video = GalleryVideo::findOrFail($id);

        $request->validate([
            'video' => 'required|string',
            'category' => 'required|string',
        ]);

        $gallery_video->update(Purify::clean([
            'video' => $request->video,
            'category' => $request->category,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryVideo updated successfully',
            'data' => GalleryVideoCollection::make($gallery_video),
        ], 200);
    }
}
