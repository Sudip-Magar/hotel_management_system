<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'room_id'
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_service');
    }
}
