<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Literature extends Model
{
    use HasFactory;
    protected $table = "literatures";
    protected $fillable = [
        'name',
        'is_pdf',
        'image',
        'file',
        'user_id',
    ];
    protected $casts = [
        'is_pdf' => 'boolean',
    ];
}
