<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Resources\DonationCollection;
use Razorpay\Api\Api;
use Uuid;

class DonationCreateController extends Controller
{
    public function donation_create(Request $request){
        $request->validate($this->validation($request));

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $receipt = Uuid::generate(4)->string;
        $orderData = [
            'receipt'         => $receipt,
            'amount'          => $request->amount*100, // 39900 rupees in paise
            'currency'        => 'INR',
            'partial_payment' => false,
        ];
        
        $razorpayOrder = $api->order->create($orderData);
        $razorpayOrderId = $razorpayOrder['id'];

        $donation = Donation::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'amount' => $request->amount,
            'pan' => $request->pan,
            'receipt' => $receipt,
            'order_id' => $razorpayOrderId,
            'trust' => $request->trust,
        ]);

        $donation = Donation::findOrFail($donation->id);


        return response()->json([
            'status' => 'success',
            'message' => 'Donation created successfully',
            'data' => DonationCollection::make($donation),
        ], 201);
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
