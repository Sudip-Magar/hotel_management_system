<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'base_price'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'category_id');
    }
}
