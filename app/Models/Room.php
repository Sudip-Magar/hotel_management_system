<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'category_id',
        'status',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
