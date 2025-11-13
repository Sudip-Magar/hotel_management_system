<?php

namespace App\Livewire\Admin\Menus;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use App\Models\GuestType as modelGuestType;

class GuestType extends Component
{

    public function fetchData()
    {
        return modelGuestType::latest()->get();
    }

    public function registerGuest($data)
    {
        try {
            $validation = validator($data, [
                'name' => 'required|min:3|max:30',
            ])->validate();

            DB::beginTransaction();
            try {
                $validation['name'] = ucfirst($validation['name']);
                modelGuestType::create($validation);
                DB::commit();
                return response()->json(['success' => 'Guest Type Creation Successfull.'], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Something went wrong'], 500);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function deleteGuestType($data)
    {
        DB::beginTransaction();
        try {
            $guestTpye = modelGuestType::findOrFail($data['id']);
            $guestTpye->delete();
            DB::commit();
            return response()->json(['success' => 'Guest Type Deleted Successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong' . $e->getMessage()], 500);
        }
    }

    public function updateGuest($data)
    {
        try {
            $validation = validator($data, [
                'name' => 'required|min:3|max:30',
            ])->validate();
            DB::beginTransaction();
            try {
                $type = modelGuestType::findOrFail($data['id']);
                // dd($validation);
                $type->update($validation);
                DB::commit();
                return response()->json(['success' => 'Guest Type Updated Successfully'], 201);
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
        return view('livewire.admin.menus.guest-type');
    }
}
