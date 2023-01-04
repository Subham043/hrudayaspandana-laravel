<?php

namespace App\Http\Controllers\GalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Http\Resources\GalleryVideoCollection;
use Uuid;
use Auth;

class GalleryVideoCreateController extends Controller
{

    public function gallery_video_create(Request $request){
        $request->validate([
            'video' => 'required|string',
            'category' => 'required|string',
        ]);

        $gallery_video = GalleryVideo::create([
            'video' => $request->video,
            'category' => $request->category,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryVideo created successfully',
            'data' => GalleryVideoCollection::make($gallery_video),
        ], 201);
    }
}
