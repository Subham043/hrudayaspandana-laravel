<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Resources\VolunteerCollection;

class VolunteerPaginateController extends Controller
{
    
    public function volunteer_paginate(Request $request){

        $volunteer = Volunteer::orderBy('id', 'DESC')->paginate(10);

        return VolunteerCollection::collection($volunteer);
    }
}
