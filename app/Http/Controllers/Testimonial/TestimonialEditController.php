<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Http\Resources\TestimonialCollection;
use Stevebauman\Purify\Facades\Purify;

class TestimonialEditController extends Controller
{

    public function testimonial_edit(Request $request, $id){
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'testimonial' => 'required|string',
            'type' => 'required|integer',
        ]);

        $testimonial->update(Purify::clean([
            'testimonial' => $request->testimonial,
            'type' => $request->type,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial updated successfully',
            'data' => TestimonialCollection::make($testimonial),
        ], 200);
    }
}
