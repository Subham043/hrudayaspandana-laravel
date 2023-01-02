<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventCollection;

class EventPaginateController extends Controller
{
    
    public function event_paginate(Request $request){

        $event = Event::orderBy('id', 'DESC');

        if ($request->has('filter')) {
            $filter = $request->input('filter');
            switch ($filter) {
                case 'Madhava Seva':
                case 'madhava-seva':
                    # code...
                    $event = $event->where(function($q) use($filter)  {
                        $q->where('category', $filter);
                    });
                    break;
                case 'Manava Seva':
                case 'manava-seva':
                    # code...
                    $event = $event->where(function($q) use($filter)  {
                        $q->where('category', $filter);
                    });
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        if ($request->has('status')) {
            $status = $request->input('status');
            $event = $event->where(function($q) use($status)  {
                $q->where('status', $status);
            });
        }

        $event = $event->paginate(10);

        return EventCollection::collection($event);
    }
}
