<?php

namespace App\Http\Controllers\Literature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Literature;
use App\Http\Resources\LiteratureCollection;

class LiteraturePaginateController extends Controller
{

    public function literature_paginate(Request $request){

        $literature = Literature::orderBy('id', 'DESC')->paginate(9);

        return LiteratureCollection::collection($literature);
    }
}
