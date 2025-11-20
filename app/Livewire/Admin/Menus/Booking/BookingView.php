<?php

namespace App\Livewire\Admin\Menus\Booking;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class BookingView extends Component
{
    public $reservation;

    public function mount($id)
    {
        $this->reservation = Reservation::with('user', 'room', 'payments', 'room.category', 'room.services', 'room.guestType', 'room.roomFeature')->findOrFail($id);
    }

    public function fetchData()
    {
        $booking = $this->reservation->load('user', 'room', 'payments', 'room.category');
        $lastPayment = $this->reservation->payments->last();
        return [$booking,$lastPayment];
    }

    public function confirmPayment($data)
    {
        try {
            $payment = Payment::where('reservation_id', $data['reservation_id'])->get()->last();
            $validation = validator($data, [
                'reservation_id' => 'required',
                'method' => 'required',
                'amount' => 'required|numeric|lte:' . $payment->amount_left,
            ])->validate();
            DB::beginTransaction();
            try {
                $validation['total_amount'] = $payment->total_amount;
                $validation['amount_left'] = $payment->amount_left - $validation['amount'];
                $validation['transaction_id'] = 'TX-' . time() . '-' . rand(1000, 9999);
                $validation['status'] = 'success';

                Payment::create($validation);
                DB::commit();
                return response()->json(['success' => 'Trnasaction successfully'], 201);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Something went wrong ' . $e->getMessage()], 500);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function render()
    {
        return view('livewire.admin.menus.booking.booking-view');
    }
}
