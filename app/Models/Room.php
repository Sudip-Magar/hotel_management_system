<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'category_id',
        'status',
        'price',
        'max_guest'
    ];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function roomImages(){
        return $this->hasMany(RoomImage::class);
    }
}
