<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Resources\BannerCollection;

class BannerDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function banner_delete($id){
        $banner = Banner::findOrFail($id);

        if($banner->image!=null && file_exists(storage_path('app/public/upload/banner').'/'.$banner->image)){
            unlink(storage_path('app/public/upload/banner/'.$banner->image));  
        }

        $banner->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Banner deleted successfully',
            'data' => BannerCollection::make($banner),
        ], 200);
    }
}
