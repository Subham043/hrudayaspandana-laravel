<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Resources\MediaCollection;

class MediaPaginateController extends Controller
{

    public function media_paginate(Request $request){

        $media = Media::orderBy('id', 'DESC')->paginate(9);

        return MediaCollection::collection($media);
    }
}
