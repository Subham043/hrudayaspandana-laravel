<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Exports\VolunteerExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use URL;
use Uuid;
use Storage;

class VolunteerExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function volunteer_excel(Request $request){
        $uuid = Uuid::generate(4)->string;
        $path = '/public/excel/'.$uuid.'.xlsx';
        $excel = Excel::store(new VolunteerExport, $path);
        return response()->json([
            'status' => 'success',
            'message' => 'Volunteer excel received successfully',
            'data' => URL::to('/').'/excel/download/'.$uuid.'.xlsx',
        ], 200);
    }
}
