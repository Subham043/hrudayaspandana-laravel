<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Http\Resources\EmailCollection;
use Uuid;
use Auth;
use Stevebauman\Purify\Facades\Purify;

class EmailCreateController extends Controller
{

    public function email_create(Request $request){
        $request->validate($this->validation($request));

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->hashName();
            $request->image->storeAs('public/upload/email',$image);
        }else{
            $image = null;
        }

        $email = Email::create(Purify::clean([
            'subject' => $request->subject,
            'message' => $request->message,
            'attachment' => $request->attachment,
            'image' => $image,
            'user_id' => Auth::user()->id,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Email created successfully',
            'data' => EmailCollection::make($email),
        ], 201);
    }

    private function validation(Request $request){
        $rules = [
            'subject' => 'required|string',
            'message' => 'required|string',
            'attachment' => 'required|boolean',
        ];
        if((bool)$request->attachment){
            $rules['image'] = 'required|mimes:jpeg,png,jpg,webp,pdf';
        }else{
            $rules['image'] = 'nullable|mimes:jpeg,png,jpg,webp,pdf';
        }
        return $rules;
    }
}
