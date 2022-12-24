<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function user_display($id){
        $decryptedId = Crypt::decryptString($id);
        $user = User::findOrFail($decryptedId);

        return response()->json([
            'status' => 'success',
            'message' => 'User received successfully',
            'data' => UserCollection::make($user),
        ], 201);
    }
}
