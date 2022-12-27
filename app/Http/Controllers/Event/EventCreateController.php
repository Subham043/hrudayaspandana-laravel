<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventCollection;
use Uuid;
use Auth;

class EventCreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function event_create(Request $request){
        $request->validate([
            'name' => 'required|string',
            'sdate' => 'required|string',
            'edate' => 'required|string',
            'stime' => 'string',
            'etime' => 'string',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'description3' => 'nullable|string',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->getClientOriginalName();
            $request->image->storeAs('public/upload/event',$image);
        }

        $event = Event::create([
            'name' => $request->name,
            'sdate' => $request->sdate,
            'edate' => $request->edate,
            'stime' => $request->stime,
            'etime' => $request->etime,
            'description1' => $request->description1,
            'description2' => $request->description2,
            'description3' => $request->description3,
            'category' => $request->category,
            'image' => $image,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Event created successfully',
            'data' => EventCollection::make($event),
        ], 201);
    }
}
