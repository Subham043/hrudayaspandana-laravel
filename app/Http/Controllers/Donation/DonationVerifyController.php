<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Resources\DonationCollection;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Jobs\SendDonationEmailJob;

class DonationVerifyController extends Controller
{

    public function donation_verify(Request $request){

        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        $donation = Donation::where('order_id',$request->razorpay_order_id)->firstOrFail();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        try
        {
            $attributes = array(
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'status' => 1,
            );

            $api->utility->verifyPaymentSignature($attributes);
        }
        catch(SignatureVerificationError $e)
        {
            //$error = 'Razorpay Error : ' . $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => 'Donation verification failed',
            ], 400);
        }

        $donation->update([
            'payment_id' => $request->razorpay_payment_id,
            'status' => 1,
        ]);

        $donation = Donation::where('order_id',$request->razorpay_order_id)->firstOrFail();

        dispatch(new SendDonationEmailJob($donation));

        return response()->json([
            'status' => 'success',
            'message' => 'Donation verified successfully',
            'data' => DonationCollection::make($donation),
        ], 200);
    }
}
