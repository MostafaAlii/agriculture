<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front;
use App\Http\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']

    ], function(){

        // front routes
        route::get('/',Livewire\front\Home::class)->name('front');
        route::get('/shop',Livewire\front\shop::class)->name('shop');
        route::get('/aboutUs',Livewire\front\AboutUs::class)->name('aboutUs');
        route::get('/blog',Livewire\front\Blog::class)->name('blog');
        route::get('/contactUs',Livewire\front\ContactUs::class)->name('contact');



        Route::middleware(['auth:vendor'])->group(function () {
        /********************************* Start  front pages with login by user auth Routes ************************************/
        // route::get('/home',[front\HomeController::class,'index'])->name('home.user');
        route::get('/home',Livewire\front\Home::class)->name('home.user');
        /********************************* End front pages with login by user auth Routes ************************************/
        route::get('/user/dashboard',Livewire\front\User\dashboard::class)->name('user.dash');
        });

        require __DIR__.'/auth.php';

    });
//     route::get('maintenance',function (){
//    if(setting()->status =='open'){
//        return redirect('/');
//    }
//    return view('front.maintenance');
//});


