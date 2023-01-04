<?php

namespace App\Http\Controllers\Crossword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crossword;
use App\Http\Resources\CrosswordCollection;

class CrosswordDisplayController extends Controller
{
    
    public function crossword_display($id){
        $crossword = Crossword::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Crossword received successfully',
            'data' => CrosswordCollection::make($crossword),
        ], 201);
    }
}
