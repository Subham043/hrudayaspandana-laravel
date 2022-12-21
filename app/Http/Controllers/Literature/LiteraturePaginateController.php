<?php

namespace App\Http\Controllers\Literature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Literature;

class LiteraturePaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function literature_paginate(Request $request){

        $literature = Literature::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Literature received successfully',
            'data' => $literature,
        ], 201);
    }
}
