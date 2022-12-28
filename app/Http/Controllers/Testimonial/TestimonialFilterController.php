<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Resources\TestimonialCollection;

class TestimonialFilterController extends Controller
{
    
    public function testimonial_filter(Request $request){
        $testimonial = Testimonial::orderBy('id', 'DESC');
        if ($request->has('filter')) {
            $filter = $request->input('filter');
            switch ($filter) {
                case '1':
                case 1:
                    # code...
                    $filter=1;
                    $testimonial = $testimonial->where(function($q) use($filter)  {
                        $q->where('type', $filter);
                    });
                    break;
                case '2':
                case 2:
                    # code...
                    $filter=2;
                    $testimonial = $testimonial->where(function($q) use($filter)  {
                        $q->where('type', $filter);
                    });
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        $testimonial = $testimonial->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial received successfully',
            'data' => TestimonialCollection::collection($testimonial),
        ], 200);
    }
}
