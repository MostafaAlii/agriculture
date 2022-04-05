<?php

use App\Http\Livewire;
use App\Http\Controllers\front;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\CommentsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','checkStatus'

        ]

    ], function(){

        // front routes
        route::get('/',Livewire\front\Home2::class)->name('front');                    //home1
        route::get('/home2',Livewire\front\Home::class)->name('front2');               //home2
        route::get('/shop',Livewire\front\shop::class)->name('shop');                   //all products
        route::get('/shop/{product_id}',Livewire\front\ProductDetails::class)->name('product_details'); //product-details
        route::get('/aboutUs',Livewire\front\AboutUs::class)->name('aboutUs');                   // about us

        route::get('/blogs',Livewire\front\Blogs::class)->name('blog');                         // blog
        Route::get('/blogs/{blog_id}',Livewire\front\BlogDetails::class)->name('blogdetails'); // blog details

        //------------------------------------------ start blogs comments----------------------------------------
        Route::post('/blogs/{blog}/comments', [CommentsController::class, 'store']);//add &replay
        Route::delete('/comments/{comment}', [CommentsController::class, 'destroy']); // url: /comments/1
        //------------------------------------------ end blogs comments----------------------------------------


        route::get('/contactUs',Livewire\front\ContactUs::class)->name('contact');             // contact us
        Route::get('/cart',Livewire\front\CartComponent::class)->name('product.cart');        //cart
        Route::get('/wishlist',Livewire\front\WishlistComponent::class)->name('product.wishlist'); //wishlist
        Route::get('/checkout',Livewire\front\Checkout::class)->name('checkout');             //checkout
        Route::get('/search',Livewire\front\SearchComponent::class)->name('product.search');  //search



        Route::middleware(['auth:vendor'])->group(function () {
        /********************************* Start  front pages with login by user auth Routes ************************************/
        // route::get('/home',[front\HomeController::class,'index'])->name('home.user');
        route::get('/home',Livewire\front\Home2::class)->name('home.user');
        /********************************* End front pages with login by user auth Routes ************************************/
        route::get('/user/dashboard',Livewire\front\User\dashboard::class)->name('user.dash');
        route::get('/user/changepassword',Livewire\front\User\UserChangePassword::class)->name('user.changepass');
        });

    require __DIR__.'/auth.php';
    });
















