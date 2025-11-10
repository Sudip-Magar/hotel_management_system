<?php

namespace App\Livewire\Admin\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.auth')]
#[Title('Admin Register')]
class Register extends Component
{
    use WithFileUploads;
    public $image;

    public function register($data)
    {
        try {
            $imagePath = null;
            if ($this->image) {
                $imagePath = $this->image->store('admin_profiles', 'public');
            }
            $validation = validator($data, [
                'name' => 'required|string|min:5|max:30',
                'email' => 'required|email|unique:users,email',
                'phone' => 'nullable|digits:10',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required|same:password',
            ])->validate();

            try {
                $validation['image'] = $imagePath;
                $validation['password'] = Hash::make($validation['password']);
                Admin::create($validation);
                session()->flash('success', 'Registration successful. You can now log in.');
                return redirect()->route('admin.login');
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Registration failed. Please try again later.' . $e->getMessage()], 500);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
    public function render()
    {
        return view('livewire.admin.auth.register');
    }
}
