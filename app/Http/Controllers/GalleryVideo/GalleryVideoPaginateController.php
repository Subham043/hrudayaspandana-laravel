<?php

namespace App\Http\Controllers\GalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Http\Resources\GalleryVideoCollection;

class GalleryVideoPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_video_paginate(Request $request){

        $gallery_video = GalleryVideo::orderBy('id', 'DESC')->paginate(10);

        return GalleryVideoCollection::collection($gallery_video);
    }
}
