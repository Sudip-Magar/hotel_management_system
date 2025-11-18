<?php

namespace App\Livewire\User\Menu;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user')]

class Reservation extends Component
{
    public function render()
    {
        return view('livewire.user.menu.reservation');
    }
}
