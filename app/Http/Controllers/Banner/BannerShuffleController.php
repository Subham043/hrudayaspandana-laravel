<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Resources\BannerCollection;

class BannerShuffleController extends Controller
{
    
    public function banner_random(){
        $banner = Banner::all()->random(3);

        return response()->json([
            'status' => 'success',
            'message' => 'Banner received successfully',
            'data' => BannerCollection::collection($banner),
        ], 200);
    }
}
