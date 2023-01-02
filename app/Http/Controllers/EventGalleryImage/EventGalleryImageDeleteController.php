<?php

namespace App\Http\Controllers\EventGalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Models\Event;
use App\Http\Resources\GalleryImageCollection;

class EventGalleryImageDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_image_delete($event_id, $id){
        $event = Event::findOrFail($event_id);
        $gallery_image = GalleryImage::findOrFail($id);

        if($gallery_image->image!=null && file_exists(storage_path('app/public/upload/gallery_image').'/'.$gallery_image->image)){
            unlink(storage_path('app/public/upload/gallery_image/'.$gallery_image->image));  
        }

        $gallery_image->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Event Gallery Image deleted successfully',
            'data' => GalleryImageCollection::make($gallery_image),
        ], 200);
    }
}
