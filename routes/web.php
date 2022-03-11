<?php

use Illuminate\Support\Facades\Route;






Route::get('/test', function () {
    return view('layouts.admin');
});


Route::group(['Middleware'=>'maintenance'],function(){
    Route::get('/',function (){
        return view('front.fronthome');
    });
});

Route::get('maintenance',function (){
    if(setting()->status ==='open'){
        return redirect('/');
    }
    return view('front.maintenance');
});
