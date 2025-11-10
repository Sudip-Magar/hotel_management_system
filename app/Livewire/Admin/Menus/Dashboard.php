<?php

namespace App\Livewire\Admin\Menus;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function mount(){
        // if(!Auth::guard('admin')->check()){
        //     session()->flash('error', 'Please log in to access the admin dashboard.');
        //     return redirect()->route('admin.login');
        // }
    }
    public function render()
    {
        return view('livewire.admin.menus.dashboard');
    }
}
