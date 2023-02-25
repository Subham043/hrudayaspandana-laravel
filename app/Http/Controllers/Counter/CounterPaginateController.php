<?php

namespace App\Http\Controllers\Counter;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Http\Resources\CounterCollection;

class CounterPaginateController extends Controller
{

    public function counter_paginate(){

        $counter = Counter::orderBy('id', 'DESC');
        $counter = $counter->paginate(9);

        return CounterCollection::collection($counter);
    }
}
