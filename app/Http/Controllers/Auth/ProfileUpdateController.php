<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserCollection;

class ProfileUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function profile_update(Request $request)
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|string|max:10|unique:users,phone,'.Auth::user()->id,
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'status' => 'success',
            'user' => UserCollection::make($user),
        ], 200);
    }
}
