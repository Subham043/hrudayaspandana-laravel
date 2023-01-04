<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Http\Resources\SubscriptionCollection;

class SubscriptionDeleteController extends Controller
{
    
    public function subscription_delete($id){
        $subscription = Subscription::findOrFail($id);

        $subscription->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Subscription deleted successfully',
            'data' => SubscriptionCollection::make($subscription),
        ], 201);
    }
}
