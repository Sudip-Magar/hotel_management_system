<?php

namespace App\Livewire\User\Menu;

use App\Models\Payment;
use App\Models\Reservation;
use App\Mail\reservation as mailReservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user')]
class RoomDetail extends Component
{
    public $room, $user;
    public function mount($id)
    {
        $this->room = Room::with('category', 'roomImages', 'services', 'guestType', 'roomFeature', 'reservations')->findOrFail($id);
        if(Auth::guard('web')->check()){
            $this->user = Auth::guard('web')->user();
        }
    }
    public function fetchData()
    {
        $room = $this->room->load('category', 'roomImages', 'services', 'guestType', 'roomFeature', 'reservations');
        // dd($this->user);
            return [$room,$this->user];
    }

    public function sendMail($payload,$paymentValidate)
    {
        $details = [
            'name' => $payload['guest_name'],
            'email' => $payload['email'],
            'phone' => $payload['guest_phone'],
            'checkin' => $payload['check_in'],
            'checkout' => $payload['check_out'],
            'total_nights' => $payload['total_nights'],
            'total_price' => $payload['total_price'],
            'room' => $this->room->room_number,
            'category' => $this->room->category->name,
            'guest_type' => $this->room->guestType->name,
            'services' => $this->room->services->pluck('name')->toArray(),
            'features' => $this->room->roomFeature,
            'amount' => $payload['amount'],
            'method' => $payload['method'],
            'transaction_id' => $paymentValidate['transaction_id'],
            'status' => $paymentValidate['status']
        ];

        $subject = "Room Reservation Confirmed – " . $this->room->room_number;

        Mail::to($payload['email'])->send(new mailReservation($details, $subject));

        session()->flash('success', 'Email sent successfully!');
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
                'email' => 'required|email'
            ])->validate();

            $paymentValidate = Validator($payload,[
                'amount' => 'required',
                'method' => 'required',
            ])->validate();

            DB::beginTransaction();
            try {
                // if(!$validation['roo'])
                $reservation = Reservation::create($validation);
                
                $paymentValidate['reservation_id'] = $reservation->id;
                $paymentValidate['transaction_id'] ='TX-' . time() . '-' . rand(1000, 9999);
                $paymentValidate['status'] = 'success';
                Payment::create($paymentValidate);
                $this->sendMail($payload,$paymentValidate);
                DB::commit();
                return response()->json(['success' => 'Reservation Successfull'], 200);
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
