<?php

namespace App\Http\Controllers\EHundi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EHundi;

class EHundiPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function ehundi_paginate(Request $request){

        $ehundi = EHundi::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'EHundi received successfully',
            'data' => $ehundi,
        ], 201);
    }
}
