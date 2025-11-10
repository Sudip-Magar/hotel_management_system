<?php

namespace App\Livewire\Admin\Menus\RoomCategory;

use App\Models\RoomCategory;
use Livewire\Component;

class RoomCategoryList extends Component
{

    public function fetchRoomCategories(){
        return RoomCategory::latest()->get();
    }
    public function render()
    {
        return view('livewire.admin.menus.room-category.room-category-list');
    }
}
