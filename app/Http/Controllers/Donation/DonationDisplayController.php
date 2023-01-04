<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Resources\DonationCollection;

class DonationDisplayController extends Controller
{
    
    public function donation_display($id){
        $donation = Donation::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Donation received successfully',
            'data' => DonationCollection::make($donation),
        ], 201);
    }
}
