<?php

namespace App\Livewire\Admin\Menus\Room;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomImage;
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
        $this->room = Room::with('category', 'roomImages')->findOrFail($id);
        $this->oldImages = RoomImage::where('room_id', $id)->get(['image'])->toArray();
    }

    public function fetchData()
    {
        $roomCategoy = RoomCategory::latest()->get();
        return [$roomCategoy, $this->room];
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

    public function updateRoom($data)
    {
        try {
            $validation = validator($data, [
                'room_number' => 'required|max:20',
                'price' => 'required|max:20',
                'category_id' => 'required',
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
