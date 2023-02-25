<?php

namespace App\Http\Controllers\EventGalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Models\Event;
use App\Http\Resources\GalleryImageCollection;
use Uuid;

class EventGalleryImageEditController extends Controller
{

    public function gallery_image_edit(Request $request, $event_id, $id){
        $event = Event::findOrFail($event_id);
        $gallery_image = GalleryImage::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|dimensions:width=800,height=500',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->getClientOriginalName();

            if($gallery_image->image!=null && file_exists(storage_path('app/public/upload/gallery_image').'/'.$gallery_image->image)){
                unlink(storage_path('app/public/upload/gallery_image/'.$gallery_image->image));
            }

            $request->image->storeAs('public/upload/gallery_image',$image);
        }else{
            $image = $gallery_image->image;
        }

        $gallery_image->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Event Gallery Image updated successfully',
            'data' => GalleryImageCollection::make($gallery_image),
        ], 200);
    }
}
