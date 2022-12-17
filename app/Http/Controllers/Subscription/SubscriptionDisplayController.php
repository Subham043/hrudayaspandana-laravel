<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Http\Resources\SubscriptionCollection;

class SubscriptionDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function subscription_display($id){
        $subscription = Subscription::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Subscription received successfully',
            'data' => SubscriptionCollection::make($subscription),
        ], 201);
    }
}
