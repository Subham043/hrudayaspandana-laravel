<?php

namespace App\Http\Controllers\GalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;

class GalleryVideoPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_video_paginate(Request $request){

        $gallery_video = GalleryVideo::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryVideo received successfully',
            'data' => $gallery_video,
        ], 200);
    }
}
