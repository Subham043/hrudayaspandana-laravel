<?php

namespace App\Http\Controllers\Crossword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crossword;
use App\Http\Resources\CrosswordCollection;
use Uuid;
use Auth;

class CrosswordCreateController extends Controller
{

    public function crossword_create(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->getClientOriginalName();
            $request->image->storeAs('public/upload/crossword',$image);
        }

        $crossword = Crossword::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Crossword created successfully',
            'data' => CrosswordCollection::make($crossword),
        ], 201);
    }
}
