<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Exceptions\UserAccessException;

class PasswordUpdateController extends Controller
{

    public function password_update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        
        if($user->status==2 || $user->status==0){
            throw new UserAccessException($user);
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
