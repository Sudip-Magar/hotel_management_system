<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'category_id',
        'status',
        'guest_type_id',
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

    public function roomImages()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'room_services');
    }

    public function guestType()
    {
        return $this->hasOne(GuestType::class);
    }

    public function roomFeature(){
        return $this->hasOne(RoomFeature::class);
    }


}
