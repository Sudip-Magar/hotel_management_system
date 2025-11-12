<?php

namespace App\Livewire\Admin\Menus\Room;

use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RoomList extends Component
{

    public function fetchData()
    {
        return Room::with('roomImages', 'category')->latest()->get();
    }

    public function deleteRoom($id)
    {
        DB::beginTransaction();
        try {
            $room = Room::findOrFail($id);
            $room->delete();
            DB::commit();
            return response()->json(['success' => 'Room category deleted successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete room category.' . $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.admin.menus.room.room-list');
    }
}
