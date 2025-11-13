<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
