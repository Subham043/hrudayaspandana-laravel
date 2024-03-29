<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Purify\Facades\Purify;

class UserPasswordController extends Controller
{

    public function user_password(Request $request, $id){
        $decryptedId = Crypt::decryptString($id);
        $user = User::findOrFail($decryptedId);

        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $user->update([
            'password' => Hash::make(Purify::clean($request->password)),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User password updated successfully',
            'data' => UserCollection::make($user),
        ], 200);
    }
}
