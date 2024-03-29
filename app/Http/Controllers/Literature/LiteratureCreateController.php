<?php

namespace App\Http\Controllers\Literature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Literature;
use App\Http\Resources\LiteratureCollection;
use Uuid;
use Auth;
use Stevebauman\Purify\Facades\Purify;

class LiteratureCreateController extends Controller
{

    public function literature_create(Request $request){
        $request->validate($this->validation($request));

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->hashName();
            $request->image->storeAs('public/upload/literature',$image);
        }else{
            $image = null;
        }

        if((bool)$request->is_pdf && $request->hasFile('file')){
            $uuid = Uuid::generate(4)->string;
            $file = $uuid.'-'.$request->file->hashName();
            $request->file->storeAs('public/upload/literature',$file);
        }else{
            $file = $request->file;
        }

        $literature = Literature::create(Purify::clean([
            'name' => $request->name,
            'image' => $image,
            'is_pdf' => $request->is_pdf,
            'file' => $file,
            'user_id' => Auth::user()->id,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Literature created successfully',
            'data' => LiteratureCollection::make($literature),
        ], 201);
    }

    private function validation(Request $request){
        $rules = [
            'name' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg,webp|dimensions:width=800,height=500',
            'is_pdf' => 'required|boolean',
        ];
        if((bool)$request->is_pdf){
            $rules['file'] = 'required|mimes:pdf';
        }else{
            $rules['file'] = 'required|string';
        }
        return $rules;
    }
}
