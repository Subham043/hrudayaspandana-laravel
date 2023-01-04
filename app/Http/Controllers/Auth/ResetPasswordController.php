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
use App\Exceptions\UserAccessException;

class ResetPasswordController extends Controller
{
    public function reset_password(Request $request, $user_id){
        $decryptedId = Crypt::decryptString($user_id);
        $user = User::where('id', $decryptedId)->firstOrFail();
        
        if($user->status==2 || $user->status==0){
            throw new UserAccessException($user);
        }
        
        if($user->status==2){
            return response()->json([
                'status' => 'error',
                'message' => 'Oops! Your account has been blocked by admin. Kindly contact us for further details!',
            ], 400);
        }
        $request->validate([
            'otp' => 'required|string|max:4',
            'password' => 'required|string|min:6',
        ]);

        if($request->otp!=$user->otp){
            return response()->json([
                'status' => 'error',
                'message' => 'Oops! You have entered wrong otp',
            ], 400);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset successful',
        ], 201);
    }
}
