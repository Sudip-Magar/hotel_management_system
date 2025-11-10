<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Title('Admin Login')]
class Login extends Component
{
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
