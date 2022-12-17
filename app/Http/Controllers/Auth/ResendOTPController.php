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

class ResendOTPController extends Controller
{
    public function send_otp(Request $request, $user_id){
        
        $decryptedId = Crypt::decryptString($user_id);
        $user = User::findOrFail($decryptedId);
        $user->otp = rand(1000,9999);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Otp sent successfully',
        ], 201);
    }
}
