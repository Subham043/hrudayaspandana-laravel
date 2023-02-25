<?php

namespace App\Http\Controllers\Counter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;
use App\Http\Resources\CounterCollection;

class CounterCreateController extends Controller
{

    public function counter_create(Request $request){
        $request->validate([
            'title' => 'required|string',
            'counter' => 'required|integer',
        ]);

        $counter = Counter::create([
            'title' => $request->title,
            'counter' => $request->counter,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Counter created successfully',
            'data' => CounterCollection::make($counter),
        ], 201);
    }
}
