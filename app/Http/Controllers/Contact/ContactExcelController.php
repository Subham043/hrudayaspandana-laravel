<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Exports\EnquiryExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use URL;
use Uuid;
use Storage;

class ContactExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function contact_excel(Request $request){
        $uuid = Uuid::generate(4)->string;
        $path = '/public/excel/'.$uuid.'.xlsx';
        $excel = Excel::store(new EnquiryExport, $path);
        return response()->json([
            'status' => 'success',
            'message' => 'Enquiry excel received successfully',
            'data' => URL::to('/').'/excel/download/'.$uuid.'.xlsx',
        ], 200);
    }
}
