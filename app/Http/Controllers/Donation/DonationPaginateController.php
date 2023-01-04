<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Resources\DonationCollection;

class DonationPaginateController extends Controller
{
    
    public function donation_paginate(Request $request){

        $donation = Donation::orderBy('id', 'DESC')->paginate(10);

        return DonationCollection::collection($donation);
    }
}
