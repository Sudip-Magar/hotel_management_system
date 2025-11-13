<?php

namespace App\Livewire\User\Menu;

use Livewire\Component;

class Room extends Component
{
        public function fetchData(){
        return \App\Models\Room::with('category','roomImages')->latest()->get();
    }


    public function render()
    {
        return view('livewire.user.menu.room');
    }
}
