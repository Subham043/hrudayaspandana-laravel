<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;

class EmailPaginateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function email_paginate(Request $request){

        $email = Email::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Email received successfully',
            'data' => $email,
        ], 201);
    }
}
