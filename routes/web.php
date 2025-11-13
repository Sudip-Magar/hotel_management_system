<?php

use App\Http\Controllers\AuthController;
use App\Livewire\User\Auth\Register;
use App\Livewire\User\Menu\Home;
use App\Livewire\User\Menu\Room;
use App\Livewire\User\Menu\RoomDetail;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login as AdminLogin;
use App\Livewire\Admin\Auth\Register as AdminRegister;
use App\Livewire\Admin\Menus\Dashboard as AdminDashboard;
use App\Livewire\Admin\Menus\RoomCategory\CreateRoomCategory as AdminCreateRoomCategory;
use App\Livewire\Admin\Menus\RoomCategory\RoomCategoryList as AdminRoomCategoryList;
use App\Livewire\Admin\Menus\RoomCategory\ViewRoomCategory as adminViewRoomCategory;
use App\Livewire\Admin\Menus\Room\CreateRoom as adminCreateRoom;
use App\Livewire\Admin\Menus\Room\RoomList as adminRoomList;
use App\Livewire\Admin\Menus\Room\ViewRoom as adminViewRoom;
use App\Livewire\Admin\Menus\GuestType as adminGuestType;
use App\Livewire\Admin\Menus\Service as adminService;

use App\Livewire\User\Auth\Login;

Route::prefix(('admin'))->group(function () {

    Route::get('/login', AdminLogin::class)->name('admin.login');
    Route::get('/register', AdminRegister::class)->name('admin.register');


    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
        Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('/room-category/create', AdminCreateRoomCategory::class)->name('admin.room-category.create');
        Route::get('/room-category/list', AdminRoomCategoryList::class)->name('admin.room-category.list');
        Route::get('/room-category/view/{id}', adminViewRoomCategory::class)->name('admin.room-category.view');
        Route::get('/room/create', adminCreateRoom::class)->name('admin.room.create');
        Route::get('/room/list', adminRoomList::class)->name('admin.room.list');
        Route::get('/room/view/{id}', adminViewRoom::class)->name('admin.room.view');
        Route::get('/guest-type',adminGuestType::class)->name('admin.guest-type');
        Route::get('/service',adminService::class)->name('admin.service');
    });
});

Route::group([], function () {

    Route::get('/login', Login::class)->name('user.login');
    Route::get('/register', Register::class)->name('user.register');
    Route::get('/',Home::class)->name('user.name');
    Route::get('/room',Room::class)->name('user.room');
    Route::get('/room/room-detail/{id}', RoomDetail::class)->name('user.room-detail');

});
