<?php

namespace App\Http\Controllers\GalleryImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Http\Resources\GalleryImageCollection;

class GalleryImagePaginateController extends Controller
{

    public function gallery_image_paginate(Request $request){

        $gallery_image = GalleryImage::orderBy('id', 'DESC');

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
                        $q->where('category', 'madhava-seva');
                    });
                    break;
                case 'Manava Seva':
                    # code...
                    $gallery_image = $gallery_image->where(function($q) use($filter)  {
                        $q->where('category', 'manava-seva');
                    });
                    break;

                default:
                    # code...
                    break;
            }
        }

        $gallery_image = $gallery_image->paginate(9);

        return GalleryImageCollection::collection($gallery_image);
    }
}
