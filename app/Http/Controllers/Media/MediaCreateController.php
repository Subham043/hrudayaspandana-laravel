<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Resources\MediaCollection;
use Uuid;

class MediaCreateController extends Controller
{

    public function media_create(Request $request){
        $request->validate($this->validation($request));

        if($request->type==1 && $request->hasFile('media')){
            $uuid = Uuid::generate(4)->string;
            $media_file = $uuid.'-'.$request->media->getClientOriginalName();
            $request->media->storeAs('public/upload/media',$media_file);
        }else{
            $media_file = $request->media;
        }

        $media = Media::create([
            'type' => $request->type,
            'media' => $media_file,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Media created successfully',
            'data' => MediaCollection::make($media),
        ], 201);
    }

    private function validation(Request $request){
        $rules = [
            'type' => 'required|integer',
        ];
        if($request->type==1){
            $rules['media'] = 'required|mimes:jpeg,png,jpg,webp|dimensions:width=800,height=500';
        }else{
            $rules['media'] = 'required|string';
        }
        return $rules;
    }
}
