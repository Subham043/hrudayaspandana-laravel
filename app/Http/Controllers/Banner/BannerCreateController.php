<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Resources\BannerCollection;
use Uuid;
use Auth;

class BannerCreateController extends Controller
{

    public function banner_create(Request $request){
        $request->validate([
            'quote' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|dimensions:width=1920,height=850',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->getClientOriginalName();
            $request->image->storeAs('public/upload/banner',$image);
        }

        $banner = Banner::create([
            'quote' => $request->quote,
            'image' => $image,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Banner created successfully',
            'data' => BannerCollection::make($banner),
        ], 201);
    }
}
