<?php

namespace App\Livewire\Admin\Menus\RoomCategory;

use App\Models\RoomCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RoomCategoryList extends Component
{

    public function fetchRoomCategories(){
        return RoomCategory::latest()->get();
    }

    public function deleteRoomCategory($id){
        DB::beginTransaction();
        try{
            $roomCategory = RoomCategory::findOrFail($id);
            $roomCategory->delete();
            DB::commit();
            return response()->json(['success' => 'Room category deleted successfully.'], 200);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete room category.'.$e->getMessage()], 500);
        }
    }
    public function render()
    {
        return view('livewire.admin.menus.room-category.room-category-list');
    }
}
