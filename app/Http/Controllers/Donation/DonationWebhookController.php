<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Resources\DonationCollection;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Jobs\SendDonationEmailJob;

class DonationWebhookController extends Controller
{

    public function donation_webhook(Request $request){

        
        // $webhookBody = '{"entity":"event","account_id":"acc_Hn1ukn2d32Fqww","event":"payment.authorized","contains":["payment"],"payload":{"payment":{"entity":{"id":"pay_JTVtDcN1uRYb5n","entity":"payment","amount":22345,"currency":"INR","status":"authorized","order_id":"order_JTVsulofMPyzBY","invoice_id":null,"international":false,"method":"card","amount_refunded":0,"refund_status":null,"captured":false,"description":"#JT8o1jsTyzrywc","card_id":"card_JTVtDjPwZbFbTM","card":{"id":"card_JTVtDjPwZbFbTM","entity":"card","name":"gaurav","last4":"4366","network":"Visa","type":"credit","issuer":"UTIB","international":false,"emi":true,"sub_type":"consumer","token_iin":null},"bank":null,"wallet":null,"vpa":null,"email":"you@example.com","contact":"+917000569565","notes":{"policy_name":"Jeevan Saral"},"fee":null,"tax":null,"error_code":null,"error_description":null,"error_source":null,"error_step":null,"error_reason":null,"acquirer_data":{"auth_code":"472379"},"created_at":1652183214}}},"created_at":1652183218}';
        $webhookBody = $request->all();
        
        $webhookSignature = env('RAZORPAY_WEBHOOK_SIGNATURE');
        $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');
        
        $donation = Donation::where('order_id',$webhookBody->payload->payment->entity->order_id)->firstOrFail();

        $donation->update([
            'test_webhook' => 'worked'
        ]);
        
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        try
        {

            $api->utility->verifyWebhookSignature($webhookBody, $webhookSignature, $webhookSecret);
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
            'payment_id' => $webhookBody->payload->payment->entity->id,
            'status' => 1,
        ]);

        $donation = Donation::where('order_id',$webhookBody->payload->payment->entity->order_id)->firstOrFail();

        dispatch(new SendDonationEmailJob($donation));

        return response()->json([
            'status' => 'success',
            'message' => 'Donation verified successfully',
            'data' => DonationCollection::make($donation),
        ], 200);
    }
}
