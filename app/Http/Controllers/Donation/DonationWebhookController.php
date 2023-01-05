<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Resources\DonationCollection;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class DonationWebhookController extends Controller
{

    public function donation_webhook(Request $request){

        $webhookSignature = $request->header('X-Razorpay-Signature');
        $webhookBody = $request->getContent();
        $data = json_decode($webhookBody);

        if($data->entity === "event" && $data->event === "payment.authorized"){
            $this->manageWebhook($webhookSignature, $webhookBody, $data);
        }
        
    }

    protected function manageWebhook($webhookSignature, $webhookBody, $data){
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');

        try
        {
            $donation = Donation::where('order_id',$data->payload->payment->entity->order_id)->firstOrFail();
            $api->utility->verifyWebhookSignature($webhookBody, $webhookSignature, $webhookSecret);
            $donation->payment_id = $data->payload->payment->entity->id;
            $donation->status = 1;
            $donation->save();
        }
        catch(SignatureVerificationError $e)
        {
            //$error = 'Razorpay Error : ' . $e->getMessage();
            error_log('failed');
        }
    }
}
