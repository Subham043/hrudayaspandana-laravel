<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Exports\SubscriptionExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use URL;
use Uuid;
use Storage;

class SubscriptionExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function subscription_excel(Request $request){
        $uuid = Uuid::generate(4)->string;
        $path = '/public/excel/'.$uuid.'.xlsx';
        $excel = Excel::store(new SubscriptionExport, $path);
        return response()->json([
            'status' => 'success',
            'message' => 'Subscription excel received successfully',
            'data' => URL::to('/').'/excel/download/'.$uuid.'.xlsx',
        ], 200);
    }
}
