<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Http\Resources\SubscriptionCollection;

class SubscriptionPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function subscription_paginate(Request $request){

        $subscription = Subscription::orderBy('id', 'DESC')->paginate(10);

        return SubscriptionCollection::collection($subscription);
    }
}
