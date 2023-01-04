<?php

namespace App\Http\Controllers\Crossword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crossword;
use App\Http\Resources\CrosswordCollection;

class CrosswordDeleteController extends Controller
{
    
    public function crossword_delete($id){
        $crossword = Crossword::findOrFail($id);

        if($crossword->image!=null && file_exists(storage_path('app/public/upload/crossword').'/'.$crossword->image)){
            unlink(storage_path('app/public/upload/crossword/'.$crossword->image));  
        }

        $crossword->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Crossword deleted successfully',
            'data' => CrosswordCollection::make($crossword),
        ], 201);
    }
}
