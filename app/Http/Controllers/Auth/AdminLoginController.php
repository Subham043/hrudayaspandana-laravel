<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Exceptions\UserAccessException;
use Stevebauman\Purify\Facades\Purify;

class AdminLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = Purify::clean($request->only('email', 'password'));
        $credentials['userType'] = 1;

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Credentials',
            ], 401);
        }

        $user = User::findOrFail(Auth::user()->id);

        if($user->status==2 || $user->status==0){
            throw new UserAccessException($user);
        }

        $user = UserCollection::make(Auth::user());
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token,
        ], 200);

    }
}
