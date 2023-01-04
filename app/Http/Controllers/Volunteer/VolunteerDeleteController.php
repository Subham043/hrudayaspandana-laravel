<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Resources\VolunteerCollection;

class VolunteerDeleteController extends Controller
{
    
    public function volunteer_delete($id){
        $volunteer = Volunteer::findOrFail($id);

        $volunteer->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer deleted successfully',
            'data' => VolunteerCollection::make($volunteer),
        ], 201);
    }
}
