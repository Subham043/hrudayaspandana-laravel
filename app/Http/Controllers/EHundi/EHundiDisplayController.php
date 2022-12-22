<?php

namespace App\Http\Controllers\EHundi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EHundi;
use App\Http\Resources\EHundiCollection;

class EHundiDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function ehundi_display($id){
        $ehundi = EHundi::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'EHundi received successfully',
            'data' => EHundiCollection::make($ehundi),
        ], 201);
    }
}
