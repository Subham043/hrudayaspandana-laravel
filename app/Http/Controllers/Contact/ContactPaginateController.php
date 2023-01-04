<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Http\Resources\EnquiryCollection;

class ContactPaginateController extends Controller
{
    
    public function contact_paginate(Request $request){

        $enquiry = Enquiry::orderBy('id', 'DESC')->paginate(10);

        return EnquiryCollection::collection($enquiry);
    }
}
