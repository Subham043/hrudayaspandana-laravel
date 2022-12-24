<?php

namespace App\Http\Controllers\GalleryAudio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryAudio;
use App\Http\Resources\GalleryAudioCollection;

class GalleryAudioDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function gallery_audio_delete($id){
        $gallery_audio = GalleryAudio::findOrFail($id);

        if($gallery_audio->audio!=null && file_exists(storage_path('app/public/upload/gallery_audio').'/'.$gallery_audio->audio)){
            unlink(storage_path('app/public/upload/gallery_audio/'.$gallery_audio->audio));  
        }

        $gallery_audio->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'GalleryAudio deleted successfully',
            'data' => GalleryAudioCollection::make($gallery_audio),
        ], 200);
    }
}
