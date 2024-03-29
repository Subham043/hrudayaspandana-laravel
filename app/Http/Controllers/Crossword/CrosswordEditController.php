<?php

namespace App\Http\Controllers\Crossword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crossword;
use App\Http\Resources\CrosswordCollection;
use Stevebauman\Purify\Facades\Purify;
use Uuid;

class CrosswordEditController extends Controller
{

    public function crossword_edit(Request $request, $id){
        $crossword = Crossword::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|dimensions:width=800,height=500',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->hashName();

            if($crossword->image!=null && file_exists(storage_path('app/public/upload/crossword').'/'.$crossword->image)){
                unlink(storage_path('app/public/upload/crossword/'.$crossword->image));
            }

            $request->image->storeAs('public/upload/crossword',$image);
        }else{
            $image = $crossword->image;
        }

        $crossword->update(Purify::clean([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Crossword updated successfully',
            'data' => CrosswordCollection::make($crossword),
        ], 200);
    }
}
