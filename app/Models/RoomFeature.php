<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFeature extends Model
{
    protected $fillable = [
        'room_id',
        'bedroom_count',
        'toilet_count',
        'has_kitchen',
        'has_balcony',
        'has_living_room',
    ];

    public function room (){
        return $this->belongsTo(Room::class);
    }
}
