<?php

namespace App\Livewire\User\Menu;

use App\Models\Room;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user')]
class RoomDetail extends Component
{
    public $room;
    public function mount($id)
    {
        $this->room = Room::with('category', 'services', 'roomImages')->findOrFail($id);
    }
    public function fetchData()
    {
        return $this->room;
    }

    public function render()
    {
        return view('livewire.user.menu.room-detail');
    }
}
