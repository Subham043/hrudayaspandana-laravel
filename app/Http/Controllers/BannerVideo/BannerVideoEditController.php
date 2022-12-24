<?php

namespace App\Http\Controllers\BannerVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerVideo;
use App\Http\Resources\BannerVideoCollection;
use Uuid;

class BannerVideoEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function banner_video_edit(Request $request){
        $banner_video = BannerVideo::findOrFail(1);

        $request->validate([
            'video' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->getClientOriginalName();
            
            if($banner_video->image!=null && file_exists(storage_path('app/public/upload/banner_video').'/'.$banner_video->image)){
                unlink(storage_path('app/public/upload/banner_video/'.$banner_video->image)); 
            }

            $request->image->storeAs('public/upload/banner_video',$image);
        }else{
            $image = $banner_video->image;
        }

        $banner_video->update([
            'video' => $request->video,
            'image' => $image,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'BannerVideo updated successfully',
            'data' => BannerVideoCollection::make($banner_video),
        ], 200);
    }
}
