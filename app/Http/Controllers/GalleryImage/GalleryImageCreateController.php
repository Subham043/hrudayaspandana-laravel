<?php

namespace App\Http\Controllers\GalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Http\Resources\GalleryImageCollection;
use Uuid;
use Auth;

class GalleryImageCreateController extends Controller
{

    public function gallery_image_create(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|dimensions:width=800,height=500',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->getClientOriginalName();
            $request->image->storeAs('public/upload/gallery_image',$image);
        }

        $gallery_image = GalleryImage::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $image,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryImage created successfully',
            'data' => GalleryImageCollection::make($gallery_image),
        ], 201);
    }
}
