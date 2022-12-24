<?php

namespace App\Http\Controllers\GalleryAudio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryAudio;
use App\Http\Resources\GalleryAudioCollection;

class GalleryAudioDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_audio_display($id){
        $gallery_audio = GalleryAudio::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryAudio received successfully',
            'data' => GalleryAudioCollection::make($gallery_audio),
        ], 201);
    }
}
