<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Resources\VolunteerPaginationCollection;

class VolunteerPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function volunteer_paginate(Request $request){

        $volunteer = Volunteer::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer received successfully',
            'data' => $volunteer,
        ], 201);
    }
}
