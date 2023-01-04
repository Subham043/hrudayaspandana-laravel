<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventCollection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EventStatusController extends Controller
{

    public function event_status($id){
        $event = Event::findOrFail($id);
        $event->status = $event->status===0 ? 1 : 0;
        $event->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Event status updated successfully',
            'data' => EventCollection::make($event),
        ], 200);
    }
}
