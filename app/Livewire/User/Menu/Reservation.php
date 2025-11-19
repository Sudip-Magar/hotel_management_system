<?php

namespace App\Livewire\User\Menu;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Reservation as modelReservation;

#[Layout('components.layouts.user')]

class Reservation extends Component
{
    public function fetchData()
    {
        if (Auth::guard('web')->check()) {
            $userId = Auth::guard('web')->user()->id;
            return modelReservation::with('user', 'room', 'room.category', 'room.guestType', 'payments')->where('user_id', $userId)->latest()->get();
        } else {
            return redirect()->route('user.room');
        }
    }

    public function savePayment($data)
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
        return view('livewire.user.menu.reservation');
    }
}
