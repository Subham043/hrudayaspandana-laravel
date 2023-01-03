<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Exports\DonationExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use URL;
use Uuid;
use Storage;

class DonationExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function donation_excel(Request $request){
        $uuid = Uuid::generate(4)->string;
        $path = '/public/excel/'.$uuid.'.xlsx';
        $excel = Excel::store(new DonationExport, $path);
        return response()->json([
            'status' => 'success',
            'message' => 'Donation excel received successfully',
            'data' => URL::to('/').'/excel/download/'.$uuid.'.xlsx',
        ], 200);
    }
}
