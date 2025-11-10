<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'reservation_id',
        'amount',
        'method',
        'transaction_id',
        'status'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
