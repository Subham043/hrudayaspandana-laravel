<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Http\Resources\SubscriptionCollection;
use Stevebauman\Purify\Facades\Purify;

class SubscriptionCreateController extends Controller
{
    public function subscription_create(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:subscriptions',
            'phone' => 'required|string|max:10|unique:subscriptions',
            'ebook' => 'required|boolean',
            'event' => 'required|boolean',
            'newsletter' => 'required|boolean',
            'blog' => 'required|boolean',
            'crossword' => 'required|boolean',
        ]);

        $subscription = Subscription::create(Purify::clean([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'ebook' => $request->ebook,
            'event' => $request->event,
            'newsletter' => $request->newsletter,
            'blog' => $request->blog,
            'crossword' => $request->crossword,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Subscription created successfully',
            'data' => SubscriptionCollection::make($subscription),
        ], 201);
    }
}
