<?php

namespace App\Http\Controllers\GalleryAudio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryAudio;
use App\Http\Resources\GalleryAudioCollection;

class GalleryAudioPaginateController extends Controller
{
    
    public function gallery_audio_paginate(Request $request){

        $gallery_audio = GalleryAudio::orderBy('id', 'DESC')->paginate(10);

        return GalleryAudioCollection::collection($gallery_audio);
    }
}
