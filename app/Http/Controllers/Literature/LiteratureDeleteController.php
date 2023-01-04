<?php

namespace App\Http\Controllers\Literature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Literature;
use App\Http\Resources\LiteratureCollection;

class LiteratureDeleteController extends Controller
{
    
    public function literature_delete($id){
        $literature = Literature::findOrFail($id);

        if($literature->image!=null && file_exists(storage_path('app/public/upload/literature').'/'.$literature->image)){
            unlink(storage_path('app/public/upload/literature/'.$literature->image));  
        }
        
        if($literature->file!=null && file_exists(storage_path('app/public/upload/literature').'/'.$literature->file)){
            unlink(storage_path('app/public/upload/literature/'.$literature->file));  
        }

        $literature->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Literature deleted successfully',
            'data' => LiteratureCollection::make($literature),
        ], 200);
    }
}
