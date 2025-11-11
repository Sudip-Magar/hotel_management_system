<?php

namespace App\Livewire\Admin\Menus\RoomCategory;

use App\Models\RoomCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateRoomCategory extends Component
{

    public function registerCategory($data)
    {
        try {
            $validation = validator($data, [
                'name' => 'required|string|min:3|max:30',
                'description' => 'nullable|string|max:255',
                'base_price' => 'required|numeric|min:0',
            ])->validate();

            try {
                RoomCategory::create($validation);
                DB::commit();
                // session()->flash('success', 'Room category created successfully.');
                return redirect()->route('admin.room-category.list')->with('success', 'Room category created successfully.');

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Failed to create room category. Please try again.'], 500);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function render()
    {
        return view('livewire.admin.menus.room-category.create-room-category');
    }
}
