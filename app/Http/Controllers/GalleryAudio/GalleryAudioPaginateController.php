<?php

namespace App\Http\Controllers\GalleryAudio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryAudio;

class GalleryAudioPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_audio_paginate(Request $request){

        $gallery_audio = GalleryAudio::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryAudio received successfully',
            'data' => $gallery_audio,
        ], 201);
    }
}
