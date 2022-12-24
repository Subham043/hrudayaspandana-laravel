<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryAudio extends Model
{
    use HasFactory;
    protected $table = "gallery_audios";
    protected $fillable = [
        'title',
        'description',
        'audio',
        'category',
        'event_id',
        'user_id',
    ];
}
