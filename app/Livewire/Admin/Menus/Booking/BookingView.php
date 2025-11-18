<?php

namespace App\Livewire\Admin\Menus\Booking;

use App\Models\Reservation;
use Livewire\Component;

class BookingView extends Component
{
    public $reservation;

    public function mount($id){
       $this->reservation = Reservation::with('user','room','payments','room.category','room.services','room.guestType','room.roomFeature')->findOrFail($id);
    }

    public function fetchData(){
        return $this->reservation->load('user','room','payments','room.category');
    }

    public function render()
    {
        return view('livewire.admin.menus.booking.booking-view');
    }
}
