<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Jobs\SendForgotPasswordEmailJob;
use App\Exceptions\UserAccessException;

class ForgotPasswordController extends Controller
{
    public function forgot_password(Request $request){
        $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        if($user->status==2 || $user->status==0){
            throw new UserAccessException($user);
        }

        $user->otp = rand(1000,9999);
        $user->save();

        dispatch(new SendForgotPasswordEmailJob($user));

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset link has been shared with your email address.',
            'user' => UserCollection::make($user),
        ], 200);
    }
}
