<?php

namespace App\Livewire\User\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.user')]
class Register extends Component
{
    use WithFileUploads;
    public $image;
    public function render()
    {
        return view('livewire.user.auth.register');
    }
}
