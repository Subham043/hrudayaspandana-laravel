<?php

namespace App\Http\Controllers\Counter;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Http\Resources\CounterCollection;

class CounterRandomController extends Controller
{

    public function counter_random(){
        $counter = Counter::all()->random(4);

        return response()->json([
            'status' => 'success',
            'message' => 'Counter received successfully',
            'data' => CounterCollection::collection($counter),
        ], 200);
    }
}
