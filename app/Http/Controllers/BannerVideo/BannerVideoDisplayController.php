<?php

namespace App\Http\Controllers\BannerVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerVideo;
use App\Http\Resources\BannerVideoCollection;

class BannerVideoDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function banner_video_display(){
        $banner_video = BannerVideo::findOrFail(1);

        return response()->json([
            'status' => 'success',
            'message' => 'BannerVideo received successfully',
            'data' => BannerVideoCollection::make($banner_video),
        ], 201);
    }
}
