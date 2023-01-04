<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserCollection;

class PasswordUpdateController extends Controller
{

    public function password_update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
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
        $request->validate([
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6',
        ]);
        if (!Hash::check($request->old_password, $user->getPassword())) {
            return response()->json([
                'status' => 'error',
                'message' => 'Oops! Incorrect Password.',
            ], 400);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'user' => UserCollection::make($user),
        ], 200);
    }
}
