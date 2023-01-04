<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;

class PdfDownloadController extends Controller
{

    public function pdf_download($file_name){
        return response()->download(Storage::path('/public/certificate/'.$file_name))->deleteFileAfterSend(true);
    }
}
