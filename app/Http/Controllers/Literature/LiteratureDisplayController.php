<?php

namespace App\Http\Controllers\Literature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Literature;
use App\Http\Resources\LiteratureCollection;

class LiteratureDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function literature_display($id){
        $literature = Literature::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Literature received successfully',
            'data' => LiteratureCollection::make($literature),
        ], 201);
    }
}
