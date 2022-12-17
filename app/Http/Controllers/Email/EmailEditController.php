<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Http\Resources\EmailCollection;
use Uuid;

class EmailEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function email_edit(Request $request, $id){
        $email = Email::findOrFail($id);

        $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
            'attachment' => 'required|boolean',
            'image' => 'nullable|mimes:jpeg,png,jpg,webp,pdf',
        ]);

        if($request->hasFile('image')){
            $uuid = Uuid::generate(4)->string;
            $image = $uuid.'-'.$request->image->getClientOriginalName();
            
            if($email->image!=null && file_exists(storage_path('app/public/upload/email').'/'.$email->image)){
                unlink(storage_path('app/public/upload/email/'.$email->image)); 
            }

            $request->image->storeAs('public/upload/email',$image);
        }else{
            $image = $email->image;
        }

        $email->update([
            'subject' => $request->subject,
            'message' => $request->message,
            'attachment' => $request->attachment,
            'image' => $image,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Email updated successfully',
            'data' => EmailCollection::make($email),
        ], 200);
    }
}
