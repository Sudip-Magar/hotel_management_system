<?php

namespace App\Livewire\Admin\Auth;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Title('Admin Login')]
class Login extends Component
{
    public function login($data)
    {
        try {
            $validation = validator($data, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ])->validate();

            if (!Auth::guard('admin')->attempt($validation)) {
                return response()->json([
                    'error' => [
                        'The provided credentials are incorrect. Please contact support if you need assistance.',
                    ],
                ], 422);
            } else {
                session()->flash('success', 'Login successful. Welcome back!');
                return redirect()->route('admin.dashboard');
            }
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
