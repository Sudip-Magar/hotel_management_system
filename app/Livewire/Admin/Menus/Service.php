<?php

namespace App\Livewire\Admin\Menus;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use App\Models\Service as modelService;

class Service extends Component
{

    public function fetchData()
    {
        return modelService::latest()->get();
    }

    public function registerGuest($data)
    {
        try {
            $validation = validator($data, [
                'name' => 'required|min:2|max:30',
            ])->validate();

            DB::beginTransaction();
            try {
                $validation['name'] = ucfirst($validation['name']);
                modelService::create($validation);
                DB::commit();
                return response()->json(['success' => 'Service Creation Successfull.'], 200);
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
            $guestTpye = modelService::findOrFail($data['id']);
            $guestTpye->delete();
            DB::commit();
            return response()->json(['success' => 'Service Deleted Successfully'], 201);
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
                $type = modelService::findOrFail($data['id']);
                // dd($validation);
                $type->update($validation);
                DB::commit();
                return response()->json(['success' => 'Service Updated Successfully'], 201);
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
        return view('livewire.admin.menus.service');
    }
}
