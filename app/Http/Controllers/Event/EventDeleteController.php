<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventCollection;

class EventDeleteController extends Controller
{
    
    public function event_delete($id){
        $event = Event::findOrFail($id);

        if($event->image!=null && file_exists(storage_path('app/public/upload/event').'/'.$event->image)){
            unlink(storage_path('app/public/upload/event/'.$event->image));  
        }

        $event->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Event deleted successfully',
            'data' => EventCollection::make($event),
        ], 200);
    }
}
