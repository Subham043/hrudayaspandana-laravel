<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Resources\MediaCollection;

class MediaPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function media_paginate(Request $request){

        $media = Media::orderBy('id', 'DESC')->paginate(10);

        return MediaCollection::collection($media);
    }
}
