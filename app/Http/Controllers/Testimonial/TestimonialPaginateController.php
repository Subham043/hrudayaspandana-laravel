<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Resources\TestimonialCollection;

class TestimonialPaginateController extends Controller
{
    
    public function testimonial_paginate(Request $request){

        $testimonial = Testimonial::orderBy('id', 'DESC')->paginate(10);

        return TestimonialCollection::collection($testimonial);
    }
}
