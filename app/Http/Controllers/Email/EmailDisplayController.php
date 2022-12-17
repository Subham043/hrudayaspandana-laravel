<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Http\Resources\EmailCollection;

class EmailDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function email_display($id){
        $email = Email::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Email received successfully',
            'data' => EmailCollection::make($email),
        ], 201);
    }
}
