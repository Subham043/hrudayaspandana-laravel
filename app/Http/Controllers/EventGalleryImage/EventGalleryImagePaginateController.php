<?php

namespace App\Http\Controllers\EventGalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Models\Event;
use App\Http\Resources\GalleryImageCollection;

class EventGalleryImagePaginateController extends Controller
{
    
    public function gallery_image_paginate(Request $request, $event_id){
        $event = Event::findOrFail($event_id);
        $gallery_image = GalleryImage::where('event_id', $event_id)->orderBy('id', 'DESC');
        
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $gallery_image = $gallery_image->where(function($q) use($search)  {
                $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('filter')) {
            $filter = $request->input('filter');
            switch ($filter) {
                case 'Madhava Seva':
                    # code...
                    $gallery_image = $gallery_image->where(function($q) use($filter)  {
                        $q->where('category', $filter);
                    });
                    break;
                case 'Manava Seva':
                    # code...
                    $gallery_image = $gallery_image->where(function($q) use($filter)  {
                        $q->where('category', $filter);
                    });
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        $gallery_image = $gallery_image->paginate(10);

        return GalleryImageCollection::collection($gallery_image);
    }
}
