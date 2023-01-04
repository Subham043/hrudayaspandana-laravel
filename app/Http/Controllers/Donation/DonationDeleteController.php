<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Resources\DonationCollection;

class DonationDeleteController extends Controller
{
    
    public function donation_delete($id){
        $donation = Donation::findOrFail($id);

        $donation->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Donation deleted successfully',
            'data' => DonationCollection::make($donation),
        ], 200);
    }
}
