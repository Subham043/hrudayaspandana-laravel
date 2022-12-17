<?php

namespace App\Http\Controllers\Crossword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crossword;

class CrosswordPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function crossword_paginate(Request $request){

        $crossword = Crossword::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Crossword received successfully',
            'data' => $crossword,
        ], 201);
    }
}
