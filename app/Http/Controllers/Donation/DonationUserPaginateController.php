<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Http\Resources\DonationCollection;
use Auth;

class DonationUserPaginateController extends Controller
{
    
    public function donation_user_paginate(Request $request){

        $user = Auth::user();
        $donation = Donation::where(function($q) use($user) {
            $q->where('email', $user->email)
            ->orWhere('phone', $user->phone);
        })->orderBy('id', 'DESC')->paginate(10);

        return DonationCollection::collection($donation);
    }
}
