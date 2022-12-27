<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventCollection;

class EventPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function event_paginate(Request $request){

        $event = Event::orderBy('id', 'DESC')->paginate(10);

        return EventCollection::collection($event);
    }
}
