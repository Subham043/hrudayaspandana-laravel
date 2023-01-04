<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Resources\MediaCollection;

class MediaDisplayController extends Controller
{
    
    public function media_display($id){
        $media = Media::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Media received successfully',
            'data' => MediaCollection::make($media),
        ], 200);
    }
}
