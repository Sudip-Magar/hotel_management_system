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

class ViewRoom extends Component
{
    use WithFileUploads;
    public $images = [];
    public $oldImages = [];
    public $room;

    public function mount($id)
    {
        $this->room = Room::with('category', 'roomImages', 'services', 'roomFeature')->findOrFail($id);
        $this->oldImages = RoomImage::where('room_id', $id)->get(['image'])->toArray();
    }

    public function fetchData()
    {
        $roomCategoy = RoomCategory::latest()->get();
        $guestType = GuestType::latest()->get();
        $allServices = Service::latest()->get();
        $room = $this->room->load('category', 'roomImages', 'services', 'roomFeature')->toArray();
        $selectedServices = $this->room->services->pluck('id')->toArray();
        return [$roomCategoy, $guestType, $room, $allServices, $selectedServices];
    }

    public function removeImage($index)
    {
        if (!empty($this->images)) {
            unset($this->images[$index]);
            $this->images = array_values($this->images); // re-index array
        } else {
            unset($this->oldImages[$index]);
            $this->oldImages = array_values($this->oldImages);
        }
    }

    public function updateRoom($data, $feature, $services)
    {
        try {
            $validation = validator($data, [
                'room_number' => 'required|max:20',
                'price' => 'required|max:20',
                'category_id' => 'required',
                'guest_type_id' => 'required',
                'max_guest' => 'required',
            ])->validate();

            try {
                $room = Room::findOrFail($this->room->id);
                $room->update($validation);

                $dbImage = RoomImage::where('room_id', $room->id);
                if (!empty($this->images)) {
                    if ($dbImage) {
                        $dbImage->delete();
                        foreach ($this->images as $image) {
                            $imagePath = $image->store('rooms', 'public');
                            RoomImage::create([
                                'room_id' => $room->id,
                                'image' => $imagePath,
                            ]);
                        }

                    } else {
                        foreach ($this->images as $image) {
                            $imagePath = $image->store('rooms', 'public');
                            RoomImage::create([
                                'room_id' => $room->id,
                                'image' => $imagePath,
                            ]);
                        }
                    }
                } else {
                    $dbImage->delete();
                    foreach ($this->oldImages as $idx => $image) {
                        // ($image['image']);
                        RoomImage::create([
                            'room_id' => $room->id,
                            'image' => $image['image'],
                        ]);
                    }
                }

                roomService::where('room_id', $room->id)->delete();
                foreach ($services as $service) {
                    roomService::create([
                        'room_id' => $room->id,
                        'service_id' => $service,
                    ]);
                }
                $roomFeature = RoomFeature::where('room_id', $room->id);
                $roomFeature->update([
                    'room_id' => $room->id,
                    'bedroom_count' => $feature['bedroom_count'],
                    'toilet_count' => $feature['toilet_count'],
                    'has_kitchen' => $feature['has_kitchen'],
                    'has_balcony' => $feature['has_balcony'],
                    'has_living_room' => $feature['has_living_room'],
                ]);


                DB::commit();

                return response()->json(['success' => 'Room Updated Successfully'], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Something went wrong' . $e->getMessage()], 500);
            }


        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function render()
    {
        return view('livewire.admin.menus.room.view-room');
    }
}
