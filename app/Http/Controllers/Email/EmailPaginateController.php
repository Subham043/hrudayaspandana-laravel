<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Http\Resources\EmailCollection;

class EmailPaginateController extends Controller
{
    
    public function email_paginate(Request $request){

        $email = Email::orderBy('id', 'DESC')->paginate(10);

        return EmailCollection::collection($email);
    }
}
