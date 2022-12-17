<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = "subscriptions";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'ebook',
        'event',
        'newsletter',
        'blog',
        'crossword',
    ];
    protected $casts = [
        'ebook' => 'boolean',
        'event' => 'boolean',
        'newsletter' => 'boolean',
        'blog' => 'boolean',
        'crossword' => 'boolean',
    ];
}
