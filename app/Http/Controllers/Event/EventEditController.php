<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventCollection;
use Uuid;
use Stevebauman\Purify\Facades\Purify;

class EventEditController extends Controller
{

    public function event_edit(Request $request, $id){
        $event = Event::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'sdate' => 'required|string',
            'edate' => 'nullable|string',
            'stime' => 'string',
            'etime' => 'string',
            'status' => 'required|string',
            'description1' => 'required|string',
            'description2' => 'nullable|string',
            'description3' => 'nullable|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|dimensions:width=800,height=500',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->hashName();

            if($event->image!=null && file_exists(storage_path('app/public/upload/event').'/'.$event->image)){
                unlink(storage_path('app/public/upload/event/'.$event->image));
            }

            $request->image->storeAs('public/upload/event',$image);
        }else{
            $image = $event->image;
        }

        $event->update(Purify::clean([
            'name' => $request->name,
            'sdate' => $request->sdate,
            'edate' => $request->edate,
            'stime' => $request->stime,
            'etime' => $request->etime,
            'status' => $request->status,
            'description1' => $request->description1,
            'description2' => $request->description2,
            'description3' => $request->description3,
            'category' => $request->category,
            'image' => $image,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Event updated successfully',
            'data' => EventCollection::make($event),
        ], 200);
    }
}
