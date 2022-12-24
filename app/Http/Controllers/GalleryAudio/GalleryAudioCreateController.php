<?php

namespace App\Http\Controllers\GalleryAudio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryAudio;
use App\Http\Resources\GalleryAudioCollection;
use Uuid;
use Auth;

class GalleryAudioCreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function gallery_audio_create(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'audio' => 'required|mimes:mp3,wav,aac',
        ]);

        if($request->hasFile('audio')){
            $uuid = Uuid::generate(4)->string;
            $audio = $uuid.'-'.$request->audio->getClientOriginalName();
            $request->audio->storeAs('public/upload/gallery_audio',$audio);
        }

        $gallery_audio = GalleryAudio::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'audio' => $audio,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryAudio created successfully',
            'data' => GalleryAudioCollection::make($gallery_audio),
        ], 201);
    }
}
