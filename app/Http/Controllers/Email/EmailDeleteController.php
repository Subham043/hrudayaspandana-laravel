<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Http\Resources\EmailCollection;

class EmailDeleteController extends Controller
{
    
    public function email_delete($id){
        $email = Email::findOrFail($id);

        if($email->image!=null && file_exists(storage_path('app/public/upload/email').'/'.$email->image)){
            unlink(storage_path('app/public/upload/email/'.$email->image));  
        }

        $email->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Email deleted successfully',
            'data' => EmailCollection::make($email),
        ], 201);
    }
}
