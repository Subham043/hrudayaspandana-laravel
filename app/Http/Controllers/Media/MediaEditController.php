<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Resources\MediaCollection;
use Uuid;

class MediaEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function media_edit(Request $request, $id){
        $media = Media::findOrFail($id);
        $request->validate($this->validation($request));
        
        if($request->type==1 && $request->hasFile('media')){
            $uuid = Uuid::generate(4)->string;
            $media_file = $uuid.'-'.$request->media->getClientOriginalName();
            
            if($media->media!=null && file_exists(storage_path('app/public/upload/media').'/'.$media->media)){
                unlink(storage_path('app/public/upload/media/'.$media->media)); 
            }

            $request->media->storeAs('public/upload/media',$media_file);
        }elseif(!empty($request->media)){
            $media_file = $request->media;
        }else{
            $media_file = $media->media;
        }

        $media->update([
            'type' => $request->type,
            'media' => $media_file,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Media updated successfully',
            'data' => MediaCollection::make($media),
        ], 200);
    }

    private function validation(Request $request){
        $rules = [
            'type' => 'required|integer',
        ];
        if($request->type==1){
            $rules['media'] = 'required|mimes:jpeg,png,jpg,webp';
        }else{
            $rules['media'] = 'required|string';
        }
        return $rules;
    }
}
