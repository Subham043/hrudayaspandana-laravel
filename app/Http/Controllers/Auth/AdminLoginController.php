<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserCollection;

class AdminLoginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $credentials['status'] = 1;
        $credentials['userType'] = 1;

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = User::findOrFail(Auth::user()->id);
        if($user->status==0){
            return response()->json([
                'status' => 'error',
                'message' => 'Oops! Please verify your email address.',
            ], 400);
        }
        if($user->status==2){
            return response()->json([
                'status' => 'error',
                'message' => 'Oops! Your account has been blocked by admin. Kindly contact us for further details!',
            ], 400);
        }

        $user = UserCollection::make(Auth::user());
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token,
        ], 200);

    }
}
