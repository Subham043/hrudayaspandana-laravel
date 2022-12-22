<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Resources\TestimonialCollection;

class TestimonialDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function testimonial_display($id){
        $testimonial = Testimonial::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial received successfully',
            'data' => TestimonialCollection::make($testimonial),
        ], 201);
    }
}
