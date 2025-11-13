<?php

namespace App\Livewire\User\Menu;

use App\Models\Room;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.user.menu.home');
    }
}
