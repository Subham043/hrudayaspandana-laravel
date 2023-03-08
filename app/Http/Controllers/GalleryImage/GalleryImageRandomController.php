<?php

namespace App\Http\Controllers\GalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Http\Resources\GalleryImageCollection;

class GalleryImageRandomController extends Controller
{

    public function gallery_image_random(){
        $gallery_image = GalleryImage::all()->random(8);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryImage received successfully',
            'data' => GalleryImageCollection::collection($gallery_image),
        ], 200);
    }
}
