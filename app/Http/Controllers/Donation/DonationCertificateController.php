<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use Pdf;
use Uuid;
use URL;

class DonationCertificateController extends Controller
{
    
    public function donation_certificate($id){
        $donation = Donation::where('status', 1)->findOrFail($id);
        $uuid = Uuid::generate(4)->string;

        $data = [
            'donation' => $donation,
        ];
          
        $pdf = PDF::loadView('pdf.certificate', $data)->setPaper('a4', 'landscape');
        $pdf->save(storage_path('app/public/certificate/').$uuid.'.pdf');

        return response()->json([
            'status' => 'success',
            'message' => 'Donation certificate received successfully',
            'data' => URL::to('/').'/pdf/download/'.$uuid.'.pdf'
        ], 201);
    }
}
