<?php

namespace App\Http\Controllers\Counter;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Http\Resources\CounterCollection;

class CounterDisplayController extends Controller
{

    public function counter_display($id){
        $counter = Counter::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Counter received successfully',
            'data' => CounterCollection::make($counter),
        ], 200);
    }
}
