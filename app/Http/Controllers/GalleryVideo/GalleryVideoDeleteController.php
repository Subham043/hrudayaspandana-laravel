<?php

namespace App\Http\Controllers\GalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Http\Resources\GalleryVideoCollection;

class GalleryVideoDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_video_delete($id){
        $gallery_video = GalleryVideo::findOrFail($id);

        $gallery_video->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryVideo deleted successfully',
            'data' => GalleryVideoCollection::make($gallery_video),
        ], 200);
    }
}
