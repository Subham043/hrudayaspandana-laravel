<?php

namespace App\Http\Controllers\EventGalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Models\Event;
use App\Http\Resources\GalleryImageCollection;
use Uuid;
use Auth;
use Stevebauman\Purify\Facades\Purify;

class EventGalleryImageCreateController extends Controller
{

    public function gallery_image_create(Request $request, $event_id){
        $event = Event::findOrFail($event_id);
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|dimensions:width=800,height=500',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->hashName();
            $request->image->storeAs('public/upload/gallery_image',$image);
        }

        $gallery_image = GalleryImage::create(Purify::clean([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $event->category,
            'event_id' => $event_id,
            'image' => $image,
            'user_id' => Auth::user()->id,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Event Gallery Image created successfully',
            'data' => GalleryImageCollection::make($gallery_image),
        ], 201);
    }
}
