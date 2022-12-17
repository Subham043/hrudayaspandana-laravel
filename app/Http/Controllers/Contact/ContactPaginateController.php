<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Http\Resources\EnquiryPaginationCollection;

class ContactPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function contact_paginate(Request $request){

        $enquiry = Enquiry::orderBy('id', 'DESC')->paginate(5);

        return response()->json([
            'status' => 'success',
            'message' => 'Enquiry received successfully',
            'data' => $enquiry,
        ], 201);
    }
}
