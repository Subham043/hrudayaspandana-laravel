<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserCollection;

class ProfileController extends Controller
{

    public function profile()
    {
        return response()->json([
            'status' => 'success',
            'user' => UserCollection::make(Auth::user()),
        ], 200);
    }
}
