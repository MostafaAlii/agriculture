<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front;
use App\Http\Livewire;

// front routes
route::get('/home',[front\HomeController::class,'index'])->name('home');
route::get('/aboutUs',[front\AboutUsController::class,'index'])->name('aboutUs');
route::get('/shop',Livewire\front\shop::class)->name('shop');
