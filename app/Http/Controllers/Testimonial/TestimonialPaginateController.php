<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function testimonial_paginate(Request $request){

        $testimonial = Testimonial::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial received successfully',
            'data' => $testimonial,
        ], 201);
    }
}
