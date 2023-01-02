<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventDetailCollection;

class EventDisplayController extends Controller
{
    
    public function event_display($id){
        $event = Event::with(['EventGalleryImage', 'EventGalleryVideo'])->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Event received successfully',
            'data' => EventDetailCollection::make($event),
            // 'data' => $event,
        ], 201);
    }
}
