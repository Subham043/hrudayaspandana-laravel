<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Resources\BannerCollection;
use Uuid;

class BannerEditController extends Controller
{

    public function banner_edit(Request $request, $id){
        $banner = Banner::findOrFail($id);

        $request->validate([
            'quote' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->getClientOriginalName();
            
            if($banner->image!=null && file_exists(storage_path('app/public/upload/banner').'/'.$banner->image)){
                unlink(storage_path('app/public/upload/banner/'.$banner->image)); 
            }

            $request->image->storeAs('public/upload/banner',$image);
        }else{
            $image = $banner->image;
        }

        $banner->update([
            'quote' => $request->quote,
            'image' => $image,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Banner updated successfully',
            'data' => BannerCollection::make($banner),
        ], 200);
    }
}
