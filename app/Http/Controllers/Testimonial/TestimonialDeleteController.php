<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Resources\TestimonialCollection;

class TestimonialDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function testimonial_delete($id){
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial deleted successfully',
            'data' => TestimonialCollection::make($testimonial),
        ], 200);
    }
}
