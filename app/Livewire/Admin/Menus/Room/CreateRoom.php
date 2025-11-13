<?php

namespace App\Livewire\Admin\Menus\Room;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomImage;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateRoom extends Component
{
    use WithFileUploads;
    public $images = [];
    public function fetchData()
    {
        return RoomCategory::latest()->get();
    }

    public function registerRoom($data, $services)
    {
        try {

            $validation = validator($data, [
                'room_number' => 'required|max:20|unique:rooms,room_number',
                'price' => 'required|max:20',
                'category_id' => 'required',
                'max_guest' => 'required',
            ])->validate();

            try {
                $room = Room::create($validation);

                if (!empty($this->images)) {
                    foreach ($this->images as $image) {
                        $imagePath = $image->store('rooms', 'public');
                        RoomImage::create([
                            'room_id' => $room->id,
                            'image' => $imagePath,
                        ]);
                    }
                }

                foreach ($services as $service) {
                    Service::create([
                        'name' => $service,
                        'room_id' => $room->id,
                    ]);
                }

                DB::commit();
                session()->flash('success', 'Room created Successfully');
                return redirect()->route('admin.room.list');
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Something went wrong' . $e->getMessage()], 500);
            }


        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images); // re-index array
    }

    public function render()
    {
        return view('livewire.admin.menus.room.create-room');
    }
}
