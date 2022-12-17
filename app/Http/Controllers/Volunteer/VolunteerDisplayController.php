<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Resources\VolunteerCollection;

class VolunteerDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function volunteer_display($id){
        $volunteer = Volunteer::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer received successfully',
            'data' => VolunteerCollection::make($volunteer),
        ], 201);
    }
}
