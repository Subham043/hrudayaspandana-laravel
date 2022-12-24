<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryVideo extends Model
{
    use HasFactory;
    protected $table = "gallery_videos";
    protected $fillable = [
        'video',
        'category',
        'event_id',
        'user_id',
    ];
}
