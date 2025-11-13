<?php

namespace App\Livewire\Admin\Menus\Room;

use App\Models\GuestType;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomFeature;
use App\Models\RoomImage;
use App\Models\roomService;
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
        $categories = RoomCategory::latest()->get();
        $guestType = GuestType::latest()->get();
        $service = Service::latest()->get();
        return [$categories, $guestType, $service];
    }

    public function registerRoom($data, $services, $feature)
    {
        try {

            $validation = validator($data, [
                'room_number' => 'required|max:20|unique:rooms,room_number',
                'price' => 'required|max:20',
                'category_id' => 'required',
                'guest_type_id' => 'required',
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
                    roomService::create([
                        'room_id' => $room->id,
                        'service_id' => $service,
                    ]);
                }

                RoomFeature::create([
                    'room_id' => $room->id,
                    'bedroom_count' => $feature['bedroom_count'],
                    'toilet_count' => $feature['toilet_count'],
                    'has_kitchen' => $feature['has_kitchen'],
                    'has_balcony' => $feature['has_balcony'],
                    'has_living_room' => $feature['has_living_room'],
                ]);

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
