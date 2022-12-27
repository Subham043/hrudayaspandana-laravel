<?php

namespace App\Http\Controllers\GalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Http\Resources\GalleryImageCollection;

class GalleryImagePaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_image_paginate(Request $request){

        $gallery_image = GalleryImage::orderBy('id', 'DESC')->paginate(10);

        return GalleryImageCollection::collection($gallery_image);
    }
}
