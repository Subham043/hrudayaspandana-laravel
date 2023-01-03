<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class UserExcelDownloadController extends Controller
{

    public function user_excel_download($file_name){
        return response()->download(Storage::path('/public/excel/'.$file_name))->deleteFileAfterSend(true);
    }
}
