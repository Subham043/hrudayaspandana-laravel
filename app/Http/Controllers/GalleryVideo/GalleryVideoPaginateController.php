<?php

namespace App\Http\Controllers\GalleryVideo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryVideo;
use App\Http\Resources\GalleryVideoCollection;

class GalleryVideoPaginateController extends Controller
{

    public function gallery_video_paginate(Request $request){

        $gallery_video = GalleryVideo::orderBy('id', 'DESC');

        if ($request->has('filter')) {
            $filter = $request->input('filter');
            switch ($filter) {
                case 'Madhava Seva':
                    # code...
                    $filter="madhava-seva";
                    $gallery_video = $gallery_video->where(function($q) use($filter)  {
                        $q->where('category', 'madhava-seva');
                    });
                    break;
                case 'Manava Seva':
                    # code...
                    $filter="manava-seva";
                    $gallery_video = $gallery_video->where(function($q) use($filter)  {
                        $q->where('category', 'manava-seva');
                    });
                    break;

                default:
                    # code...
                    break;
            }
        }

        $gallery_video = $gallery_video->paginate(9);

        return GalleryVideoCollection::collection($gallery_video);
    }
}
