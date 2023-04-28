<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Resources\DonationCollection;
use Stevebauman\Purify\Facades\Purify;

class DonationEditController extends Controller
{

    public function donation_edit(Request $request, $id){
        $donation = Donation::findOrFail($id);

        $request->validate($this->validation($request));

        $donation->update(Purify::clean([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'amount' => $request->amount,
            'pan' => $request->pan,
            'trust' => $request->trust,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Donation updated successfully',
            'data' => DonationCollection::make($donation),
        ], 200);
    }

    private function validation(Request $request){
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:10',
            'city' => 'required|string|min:3',
            'state' => 'required|string|min:3',
            'amount' => 'required|integer',
            'trust' => 'required|integer',
        ];
        if($request->trust==1){
            $rules['pan'] = 'required|string';
        }
        return $rules;
    }
}
