<?php

namespace App\Livewire\User\Menu;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Room as modelRoom;

#[Layout('components.layouts.user')]

class Room extends Component
{
    public function fetchData()
    {
        $rooms = modelRoom::with('category', 'roomImages', 'services', 'guestType', 'roomFeature')->latest()->get();
        // $rooms->load('category', 'roomImages', 'services', 'guestType', 'roomFeature');
        return $rooms;

    }


    public function render()
    {
        return view('livewire.user.menu.room');
    }
}
