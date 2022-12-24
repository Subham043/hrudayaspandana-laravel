<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function user_status($id){
        $decryptedId = Crypt::decryptString($id);
        $user = User::findOrFail($decryptedId);

        $user->update([
            'status' => $user->status==1 ? 2 : 1,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User status updated successfully',
            'data' => UserCollection::make($user),
        ], 200);
    }
}
