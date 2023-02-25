<?php

namespace App\Http\Controllers\Counter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;
use App\Http\Resources\CounterCollection;

class CounterEditController extends Controller
{

    public function counter_edit(Request $request, $id){
        $counter = Counter::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'counter' => 'required|integer',
        ]);

        $counter->update([
            'title' => $request->title,
            'counter' => $request->counter,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Counter updated successfully',
            'data' => CounterCollection::make($counter),
        ], 200);
    }
}
