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
        route::get('/',Livewire\front\Home2::class)->name('front');                    //home1
        route::get('/home2',Livewire\front\Home::class)->name('front2');               //home2
        route::get('/shop',Livewire\front\shop::class)->name('shop');                   //shop
        route::get('/aboutUs',Livewire\front\AboutUs::class)->name('aboutUs');          // about us
        route::get('/blogs',Livewire\front\Blogs::class)->name('blog');               // blog
        Route::get('/blogs/{blog_id}',Livewire\front\BlogDetails::class)->name('blogdetails'); // blog details
        route::get('/contactUs',Livewire\front\ContactUs::class)->name('contact');      // contact us



        Route::middleware(['auth:vendor'])->group(function () {
        /********************************* Start  front pages with login by user auth Routes ************************************/
        // route::get('/home',[front\HomeController::class,'index'])->name('home.user');
        route::get('/home',Livewire\front\Home2::class)->name('home.user');
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


