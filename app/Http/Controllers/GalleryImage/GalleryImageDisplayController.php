<?php

namespace App\Http\Controllers\GalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Http\Resources\GalleryImageCollection;

class GalleryImageDisplayController extends Controller
{
    
    public function gallery_image_display($id){
        $gallery_image = GalleryImage::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryImage received successfully',
            'data' => GalleryImageCollection::make($gallery_image),
        ], 201);
    }
}
