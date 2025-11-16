<?php

namespace App\Livewire\User\Menu;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user')]
class RoomDetail extends Component
{
    public $room;
    public function mount($id)
    {
        $this->room = Room::with('category', 'roomImages', 'services', 'guestType', 'roomFeature', 'reservations')->findOrFail($id);
        // return $room;
    }
    public function fetchData()
    {
        $room = $this->room->load('category', 'roomImages', 'services', 'guestType', 'roomFeature', 'reservations');
        return $room;
    }

    public function reserve($payload)
    {
        try {
            $validation = Validator($payload, [
                'room_id' => 'required',
                'check_in' => 'required',
                'check_out' => 'required',
                'total_nights' => 'required',
                'total_price' => 'required',
                'payment_status' => 'required',
                'booking_status' => 'required',
                'guest_name' => 'required|min:3|max:30',
                'guest_phone' => 'required|digits:10',
            ])->validate();

            DB::beginTransaction();
            try {
                // if(!$validation['roo'])
                Reservation::create($validation);
                DB::commit();
                return response()->json(['success' => 'Reservation Successfull'],200);
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
        return view('livewire.user.menu.room-detail');
    }
}
