<?php

namespace App\Http\Controllers\Counter;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Http\Resources\CounterCollection;

class CounterDeleteController extends Controller
{

    public function counter_delete($id){
        $counter = Counter::findOrFail($id);

        $counter->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Counter deleted successfully',
            'data' => CounterCollection::make($counter),
        ], 200);
    }
}
