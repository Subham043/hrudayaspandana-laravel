<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Http\Resources\VolunteerCollection;
use App\Jobs\SendVolunteerEmailJob;

class VolunteerCreateController extends Controller
{
    public function volunteer_create(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:volunteers',
            'phone' => 'required|string|max:10|unique:volunteers',
            'aadhar' => 'required|string|max:12',
            'address' => 'required|string|min:6',
            'interest' => 'nullable|string|min:6',
        ]);

        $volunteer = Volunteer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'aadhar' => $request->aadhar,
            'address' => $request->address,
            'interest' => $request->interest,
        ]);

        dispatch(new SendVolunteerEmailJob($volunteer));

        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer created successfully',
            'data' => VolunteerCollection::make($volunteer),
        ], 201);
    }
}
