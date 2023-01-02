<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Models\Subscription;
use App\Http\Resources\EmailCollection;
use App\Jobs\SendCustomEmailJob;

class EmailSendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function email_send($id){
        $email = EmailCollection::make(Email::findOrFail($id));
        $subscribed = Subscription::all()->pluck('email');

        dispatch(new SendCustomEmailJob($email, $subscribed));

        return response()->json([
            'status' => 'success',
            'message' => 'Email sent successfully',
        ], 200);
    }
}
