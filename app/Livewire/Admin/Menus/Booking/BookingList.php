<?php

namespace App\Livewire\Admin\Menus\Booking;

use App\Models\Reservation;
use Livewire\Component;

class BookingList extends Component
{
    public function allBook(){
       return Reservation::with('user','room','payments')->latest()->get();
    }
    public function render()
    {
        return view('livewire.admin.menus.booking.booking-list');
    }
}
