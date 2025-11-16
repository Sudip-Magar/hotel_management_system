<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        session()->flash('success', 'Logged out successfully.');

        return redirect()->route('admin.login');
    }

    public function userLogout(){
        auth()->guard('web')->logout();
        session()->flash('success', 'Logged out successfully');
        return redirect()->back();
    }
}
