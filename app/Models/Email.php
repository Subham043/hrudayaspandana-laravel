<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $table = "emails";
    protected $fillable = [
        'subject',
        'message',
        'attachment',
        'image',
        'user_id',
    ];
    protected $casts = [
        'attachment' => 'boolean',
    ];
}
