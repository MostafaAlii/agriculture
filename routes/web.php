<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front;


// front routes
route::get('/',[front\HomeController::class,'index'])->name('home');

// end front routes





Route::get('/test', function () {
    return view('layouts.admin');
});
