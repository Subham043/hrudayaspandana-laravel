<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Resources\MediaCollection;

class MediaDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function media_delete($id){
        $media = Media::findOrFail($id);

        if($media->media!=null && file_exists(storage_path('app/public/upload/media').'/'.$media->media)){
            unlink(storage_path('app/public/upload/media/'.$media->media));  
        }

        $media->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Media deleted successfully',
            'data' => MediaCollection::make($media),
        ], 200);
    }
}
