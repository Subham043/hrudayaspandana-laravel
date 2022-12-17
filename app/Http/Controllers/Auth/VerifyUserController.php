<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;

class VerifyUserController extends Controller
{
    public function verify_user(Request $request, $user_id){
        $decryptedId = Crypt::decryptString($user_id);
        $user = User::findOrFail($decryptedId);
        $request->validate([
            'otp' => 'required|string|max:4',
        ]);

        if($request->otp!=$user->otp){
            return response()->json([
                'status' => 'error',
                'message' => 'Oops! You have entered wrong otp',
            ], 400);
        }

        $user->otp = rand(1000,9999);
        $user->status = 1;
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->save();

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => UserCollection::make($user),
            'access_token' => $token,
        ], 201);
    }
}
