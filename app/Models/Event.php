<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = "events";
    protected $fillable = [
        'name',
        'sdate',
        'edate',
        'stime',
        'etime',
        'description1',
        'description2',
        'description3',
        'image',
        'category',
        'status',
        'user_id',
    ];

    public function EventGalleryImage()
    {
        return $this->hasMany('App\Models\GalleryImage', 'event_id');
    }
    
    public function EventGalleryVideo()
    {
        return $this->hasMany('App\Models\GalleryVideo', 'event_id');
    }
}
