<?php

namespace App\Http\Controllers\GalleryAudio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryAudio;
use App\Http\Resources\GalleryAudioCollection;
use Uuid;

class GalleryAudioEditController extends Controller
{

    public function gallery_audio_edit(Request $request, $id){
        $gallery_audio = GalleryAudio::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'audio' => 'nullable|mimes:jmp3,wav,aac',
        ]);

        if($request->hasFile('audio')){
            $uuid = Uuid::generate(4)->string;
            $audio = $uuid.'-'.$request->audio->getClientOriginalName();
            
            if($gallery_audio->audio!=null && file_exists(storage_path('app/public/upload/gallery_audio').'/'.$gallery_audio->audio)){
                unlink(storage_path('app/public/upload/gallery_audio/'.$gallery_audio->audio)); 
            }

            $request->audio->storeAs('public/upload/gallery_audio',$audio);
        }else{
            $audio = $gallery_audio->audio;
        }

        $gallery_audio->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'audio' => $audio,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryAudio updated successfully',
            'data' => GalleryAudioCollection::make($gallery_audio),
        ], 200);
    }
}
