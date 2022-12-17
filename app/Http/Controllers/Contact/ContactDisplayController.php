<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Http\Resources\EnquiryCollection;

class ContactDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function contact_display($id){
        $enquiry = Enquiry::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Enquiry received successfully',
            'data' => EnquiryCollection::make($enquiry),
        ], 201);
    }
}
