<?php

namespace App\Exceptions;

use Exception;
use App\Models\User;
use App\Jobs\SendVerificationEmailJob;

class UserAccessException extends Exception
{
    protected $data;
    protected $message = "Oops! you dont have the permission to access this!";
    public function __construct($data = null)
    {
        parent::__construct($data);

        $this->data = $data;
    }

    public function showCustomErrorMessage()
    {
        if($this->data->status==0){
            $this->message = 'Oops! Please verify your email address.';
            $user = User::where('email', $this->data->email)->firstOrFail();
            dispatch(new SendVerificationEmailJob($user));
        }
        if($this->data->status==2){
            $this->message = 'Oops! Your account has been blocked by admin. Kindly contact us for further details!';
        }
        return $this->message;
    }
}