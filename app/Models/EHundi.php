<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EHundi extends Model
{
    use HasFactory;
    protected $table = "e_hundis";
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
        'state',
        'amount',
        'trust',
        'pan',
    ];
}
