<?php

namespace App\Livewire\Admin\Menus\RoomCategory;

use App\Models\RoomCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ViewRoomCategory extends Component
{
    public $category;
    public function mount($id)
    {
        $this->category = RoomCategory::findOrFail($id);
        
    }

    public function fetchRoomCategory(){
        return $this->category;
    }

    public function updateCategory($data){
        try{
            $validation = validator($data,[
                'name' => 'required|string|min:3|max:30',
                'description' => 'nullable|string|max:255',
                'base_price' => 'required|numeric|min:0',
            ])->validate();

            DB::beginTransaction();
            try{
                $room = RoomCategory::findOrFail($this->category->id);
                $room->update($validation);
                // dd($room);
                DB::commit();
                return response()->json(['success' => 'Room Category Updated Successfully'],200);
            }
            catch(\Exception $e){
                DB::rollBack();
                return response()->json(['error' => 'Something went wrong'.$e->getMessage()],500);
            }
        }
        catch(ValidationException $e){
            return response()->json(['errors' => $e->errors()],422);
        }
    }

    public function render()
    {
        return view('livewire.admin.menus.room-category.view-room-category');
    }
}
