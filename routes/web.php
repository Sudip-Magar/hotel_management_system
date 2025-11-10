<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login as AdminLogin;
use App\Livewire\Admin\Auth\Register as AdminRegister;
use App\Livewire\Admin\Menus\Dashboard as AdminDashboard;

use App\Livewire\User\Auth\Login;

Route::prefix(('admin'))->group(function () {

    Route::get('/login', AdminLogin::class)->name('admin.login');
    Route::get('/register', AdminRegister::class)->name('admin.register');


    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    });
});

Route::prefix(('user'))->group(function () {

    Route::get('/login', Login::class)->name('user.login');

});
