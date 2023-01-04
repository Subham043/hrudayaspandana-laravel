<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Resources\VolunteerCollection;

class VolunteerEditController extends Controller
{

    public function volunteer_edit(Request $request, $id){
        $volunteer = Volunteer::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:volunteers,email,'.$id,
            'phone' => 'required|string|max:10|unique:volunteers,phone,'.$id,
            'aadhar' => 'required|string|max:12',
            'address' => 'required|string|min:6',
            'interest' => 'nullable|string|min:6',
        ]);

        $volunteer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'aadhar' => $request->aadhar,
            'address' => $request->address,
            'interest' => $request->interest,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer updated successfully',
            'data' => VolunteerCollection::make($volunteer),
        ], 200);
    }
}
