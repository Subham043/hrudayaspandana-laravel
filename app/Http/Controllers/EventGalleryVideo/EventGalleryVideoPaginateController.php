<?php

namespace App\Http\Controllers\EventGalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Http\Resources\GalleryVideoCollection;

class EventGalleryVideoPaginateController extends Controller
{
    
    public function gallery_video_paginate(Request $request, $event_id){
        $event = Event::findOrFail($event_id);

        $gallery_video = GalleryVideo::where('event_id', $event_id)->orderBy('id', 'DESC');

        if ($request->has('filter')) {
            $filter = $request->input('filter');
            switch ($filter) {
                case 'Madhava Seva':
                    # code...
                    $filter="madhava-seva";
                    $gallery_video = $gallery_video->where(function($q) use($filter)  {
                        $q->where('category', $filter);
                    });
                    break;
                case 'Manava Seva':
                    # code...
                    $filter="manava-seva";
                    $gallery_video = $gallery_video->where(function($q) use($filter)  {
                        $q->where('category', $filter);
                    });
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        $gallery_video = $gallery_video->paginate(10);

        return GalleryVideoCollection::collection($gallery_video);
    }
}
