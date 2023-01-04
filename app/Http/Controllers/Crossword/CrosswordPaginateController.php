<?php

namespace App\Http\Controllers\Crossword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crossword;
use App\Http\Resources\CrosswordCollection;

class CrosswordPaginateController extends Controller
{
    
    public function crossword_paginate(Request $request){

        $crossword = Crossword::orderBy('id', 'DESC')->paginate(10);

        return CrosswordCollection::collection($crossword);
    }
}
