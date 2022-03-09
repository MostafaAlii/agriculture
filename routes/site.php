<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front;
use App\Http\Livewire;

// front routes
route::get('/',[front\HomeController::class,'index'])->name('front');
route::get('/aboutUs',[front\AboutUsController::class,'index'])->name('aboutUs');
route::get('/shop',Livewire\front\shop::class)->name('shop');



Route::middleware(['web','auth:vendor'])->group(function () {
  /********************************* Start  front pages with login by user auth Routes ************************************/
  route::get('/home',[front\HomeController::class,'index'])->name('home.user');
  /********************************* End front pages with login by user auth Routes ************************************/
  route::get('/user/dashboard',Livewire\front\User\dashboard::class)->name('user.dash');
});

require __DIR__.'/auth.php';


