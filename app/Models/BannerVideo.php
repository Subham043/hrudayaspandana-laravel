<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerVideo extends Model
{
    use HasFactory;
    protected $table = "banner_videos";
    protected $fillable = [
        'image',
        'video',
    ];
}
