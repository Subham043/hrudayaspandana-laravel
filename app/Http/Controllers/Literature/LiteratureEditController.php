<?php

namespace App\Http\Controllers\Literature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Literature;
use App\Http\Resources\LiteratureCollection;
use Uuid;

class LiteratureEditController extends Controller
{

    public function literature_edit(Request $request, $id){
        $literature = Literature::findOrFail($id);
        $request->validate($this->validation($request));

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->getClientOriginalName();

            if($literature->image!=null && file_exists(storage_path('app/public/upload/literature').'/'.$literature->image)){
                unlink(storage_path('app/public/upload/literature/'.$literature->image));
            }

            $request->image->storeAs('public/upload/literature',$image);
        }else{
            $image = $literature->image;
        }

        if((bool)$request->is_pdf && $request->hasFile('file')){
            $uuid = Uuid::generate(4)->string;
            $file = $uuid.'-'.$request->file->getClientOriginalName();

            if($literature->file!=null && file_exists(storage_path('app/public/upload/literature').'/'.$literature->file)){
                unlink(storage_path('app/public/upload/literature/'.$literature->file));
            }

            $request->file->storeAs('public/upload/literature',$file);
        }elseif($request->file){
            $file = $request->file;
        }else{
            $file = $literature->file;
        }

        $literature->update([
            'name' => $request->name,
            'is_pdf' => $request->is_pdf,
            'image' => $image,
            'file' => $file,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Literature updated successfully',
            'data' => LiteratureCollection::make($literature),
        ], 200);
    }

    private function validation(Request $request){
        $rules = [
            'name' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,webp|dimensions:width=800,height=500',
            'is_pdf' => 'required|boolean',
        ];
        if((bool)$request->is_pdf){
            $rules['file'] = 'nullable|mimes:pdf';
        }else{
            $rules['file'] = 'nullable|string';
        }
        return $rules;
    }
}
