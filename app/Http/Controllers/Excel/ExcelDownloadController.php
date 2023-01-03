<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class ExcelDownloadController extends Controller
{

    public function excel_download($file_name){
        return response()->download(Storage::path('/public/excel/'.$file_name))->deleteFileAfterSend(true);
    }
}
