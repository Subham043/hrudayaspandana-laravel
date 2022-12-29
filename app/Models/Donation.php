<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $table = "donations";
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
        'order_id',
        'receipt',
        'payment_id',
        'status',
    ];
}
