<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserCollection;

class ForgotPasswordController extends Controller
{
    public function forgot_password(Request $request){
        $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

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

        $user->otp = rand(1000,9999);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset link has been shared with your email address.',
            'user' => UserCollection::make($user),
        ], 200);
    }
}
