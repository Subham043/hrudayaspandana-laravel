<?php

namespace App\Http\Controllers\EHundi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EHundi;
use App\Http\Resources\EHundiCollection;

class EHundiEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function ehundi_edit(Request $request, $id){
        $ehundi = EHundi::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:10',
            'city' => 'required|string|min:3',
            'state' => 'required|string|min:3',
            'amount' => 'required|integer',
            'trust' => 'required|integer',
        ]);

        $ehundi->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'amount' => $request->amount,
            'trust' => $request->trust,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'EHundi updated successfully',
            'data' => EHundiCollection::make($ehundi),
        ], 200);
    }
}