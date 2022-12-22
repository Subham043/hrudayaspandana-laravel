<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Resources\TestimonialCollection;

class TestimonialCreateController extends Controller
{
    public function testimonial_create(Request $request){
        $request->validate([
            'testimonial' => 'required|string',
            'type' => 'required|integer',
        ]);

        $testimonial = Testimonial::create([
            'testimonial' => $request->testimonial,
            'type' => $request->type,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial created successfully',
            'data' => TestimonialCollection::make($testimonial),
        ], 201);
    }
}
