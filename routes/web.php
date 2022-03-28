<?php


use Illuminate\Support\Facades\Route;

Route::get('/maintenance', function () {
    return view('front.maintenance');
});