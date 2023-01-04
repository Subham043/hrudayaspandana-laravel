<?php

namespace App\Http\Controllers\GalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Http\Resources\GalleryVideoCollection;

class GalleryVideoDisplayController extends Controller
{
    
    public function gallery_video_display($id){
        $gallery_video = GalleryVideo::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryVideo received successfully',
            'data' => GalleryVideoCollection::make($gallery_video),
        ], 201);
    }
}
