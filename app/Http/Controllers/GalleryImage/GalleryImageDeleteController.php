<?php

namespace App\Http\Controllers\GalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Http\Resources\GalleryImageCollection;

class GalleryImageDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_image_delete($id){
        $gallery_image = GalleryImage::findOrFail($id);

        if($gallery_image->image!=null && file_exists(storage_path('app/public/upload/gallery_image').'/'.$gallery_image->image)){
            unlink(storage_path('app/public/upload/gallery_image/'.$gallery_image->image));  
        }

        $gallery_image->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryImage deleted successfully',
            'data' => GalleryImageCollection::make($gallery_image),
        ], 200);
    }
}
