<?php

namespace App\Livewire\User\Menu;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Reservation as modelReservation;

#[Layout('components.layouts.user')]

class Reservation extends Component
{
    public function fetchData(){
       if(Auth::guard('web')->check()){
         $userId = Auth::guard('web')->user()->id;
        return modelReservation::with('user','room','room.category','room.guestType','payments')->where('user_id',$userId)->latest()->get();
       }
       else{
        return redirect()->route('user.room');
       }
    }
    public function render()
    {
        return view('livewire.user.menu.reservation');
    }
}
