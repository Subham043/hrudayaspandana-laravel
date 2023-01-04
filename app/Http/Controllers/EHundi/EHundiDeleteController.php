<?php

namespace App\Http\Controllers\EHundi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EHundi;
use App\Http\Resources\EHundiCollection;

class EHundiDeleteController extends Controller
{
    
    public function ehundi_delete($id){
        $ehundi = EHundi::findOrFail($id);

        $ehundi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'EHundi deleted successfully',
            'data' => EHundiCollection::make($ehundi),
        ], 200);
    }
}
