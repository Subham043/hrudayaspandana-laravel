<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventCollection;

class EventDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function event_display($id){
        $event = Event::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Event received successfully',
            'data' => EventCollection::make($event),
        ], 201);
    }
}
