<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Http\Resources\EnquiryCollection;

class ContactDeleteController extends Controller
{
    
    public function contact_delete($id){
        $enquiry = Enquiry::findOrFail($id);

        $enquiry->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Enquiry deleted successfully',
            'data' => EnquiryCollection::make($enquiry),
        ], 201);
    }
}
