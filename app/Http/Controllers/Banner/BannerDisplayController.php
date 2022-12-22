<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Resources\BannerCollection;

class BannerDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function banner_display($id){
        $banner = Banner::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Banner received successfully',
            'data' => BannerCollection::make($banner),
        ], 201);
    }
}
