<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Exceptions\UserAccessException;

class ProfileUpdateController extends Controller
{

    public function profile_update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        
        if($user->status==2 || $user->status==0){
            throw new UserAccessException($user);
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
