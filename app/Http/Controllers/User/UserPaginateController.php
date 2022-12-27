<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserCollection;

class UserPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function user_paginate(Request $request){

        $user = User::orderBy('id', 'DESC')->paginate(10);
        return UserCollection::collection($user);
    }
}
