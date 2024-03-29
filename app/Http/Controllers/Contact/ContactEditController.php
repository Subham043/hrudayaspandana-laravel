<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Http\Resources\EnquiryCollection;
use Stevebauman\Purify\Facades\Purify;

class ContactEditController extends Controller
{

    public function contact_edit(Request $request, $id){
        $enquiry = Enquiry::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:10',
            'message' => 'required|string|min:6',
        ]);

        $enquiry->update(Purify::clean([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Enquiry updated successfully',
            'data' => EnquiryCollection::make($enquiry),
        ], 200);
    }
}
