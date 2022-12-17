<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crossword extends Model
{
    use HasFactory;
    protected $table = "crosswords";
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];
}
