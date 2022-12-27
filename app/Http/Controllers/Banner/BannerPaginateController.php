<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Resources\BannerCollection;

class BannerPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function banner_paginate(Request $request){

        $banner = Banner::orderBy('id', 'DESC')->paginate(10);
        return BannerCollection::collection($banner);

    }
}
