<?php
use App\Http\Livewire;
use App\Http\Controllers\front;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\front\SearchController;
use App\Http\Controllers\front\RatingsController;
use App\Http\Controllers\front\CommentsController;
use App\Http\Livewire\Front\User\ThankYouComponent;
use App\Http\Controllers\front\user\UserEditProfile;
use App\Http\Controllers\front\FarmerAllDataController;
use App\Http\Controllers\front\WorkerAllDataController;
use App\Http\Controllers\front\PaymentMethodController;
use App\Http\Controllers\front\vendor\VendorController;
use App\Http\Controllers\front\CategoryProductController;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Livewire\Front\User\UserOrderDetailsComponent;
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

        Route::post('/sendmails',[GuestController::class, 'sendmails'])->name('guest.sendmails'); // guest send mail ****************
        //--------------------------------search with tag-------------------------------------------------------
        Route::get('/blogs.search/{blog_id}/{type}',[SearchController::class,'search'])->name('blogs.search'); // blog details
        Route::get('/blogs.search2/{text}',[SearchController::class,'search2'])->name('blogs.search2'); // blog details
        Route::get('/products.search/{product_id}/{type}',[SearchController::class,'search_product'])->name('products.search'); // blog details

        //----------------------------------farmer---------------------------------------------------------------
        Route::get('/farmer',[FarmerAllDataController::class,'get_farmer'])->name('farmer'); // all farmer
        route::get('/farmer/{id}',[FarmerAllDataController::class,'farmer_detail'])->name('farmer_detail'); //farmer detail
        //----------------------------------worker---------------------------------------------------------------
        Route::get('/worker',[WorkerAllDataController::class,'get_worker'])->name('servworker'); // all worker
        route::get('/worker_details/{id}',[WorkerAllDataController::class,'worker_details'])->name('worker_details'); //worker detail

        //------------------------------------------ start blogs & products comments----------------------------------------
        Route::post('/blogs/{blog}/comments', [CommentsController::class, 'store_blog']);//add &replay (blog)
        Route::post('/products/{product}/comments', [CommentsController::class, 'store_product']);//add &replay (product)
        Route::post('/farmers/{farmer}/comments', [CommentsController::class, 'store_farmer']);//add &replay (farmer)
        Route::delete('/comments/{comment}', [CommentsController::class, 'destroy']); // url: /comments/1
        //------------------------------------------ end blogs & products comments----------------------------------------


        route::get('/contactUs',Livewire\front\ContactUs::class)->name('contact');             // contact us
        Route::get('/search',Livewire\front\SearchComponent::class)->name('product.search');  //search



        Route::middleware(['auth:vendor'])->group(function () {
            /********************************* Start  front pages with login by user auth Routes ************************************/
            route::get('/home',Livewire\front\Home2::class)->name('front');
            /********************************* End front pages with login by user auth Routes ************************************/

            Route::group(['prefix' => 'user'], function () {
                route::get('/',[VendorController::class, 'index'])->name('vendor.dashboard');
                Route::get('/myOrders',[VendorController::class, 'orders'])->name('vendor.orders');
                Route::get('/myOrders/Details/{order_id}',UserOrderDetailsComponent::class)->name('vendor.orderDetais');
                /************************************************************************************************** */
                route::get('/ownprofile',Livewire\front\User\UserProfile::class)->name('user.ownprofile'); //user profile
                route::get('/ownprofile/edit',Livewire\front\User\UserEditProfileComponent::class)->name('user.editownprofile'); //user Edit profile
                route::get('/changepassword',Livewire\front\User\UserChangePassword::class)->name('user.changepass');
            });
            // route::get('/user/ownprofile/edit',Livewire\front\User\UserEditProfileComponent::class)->name('user.editownprofile'); //user Edit profile

            route::get('/user/ownprofile/edit',[UserEditProfile::class,'editProfile'])->name('user.editownprofile'); //user Edit profile
            route::put('/user/ownprofile/update',[UserEditProfile::class,'update'])->name('user.ownprofile.update'); //user update profile
            // ajax routes ***********************************
            Route::get('/user/province/{country_id}', [UserEditProfile::class, 'getProvince']);// route ajax for get country provinces
            Route::get('/user/area/{province_id}', [UserEditProfile::class, 'getArea']);// route ajax for get province areas
            Route::get('/user/state/{area_id}', [UserEditProfile::class, 'getState']);// route ajax for get areas states
            Route::get('/user/village/{state_id}', [UserEditProfile::class, 'getVillage']);// route ajax for get state villages

            route::get('/user/changepassword',Livewire\front\User\UserChangePassword::class)->name('user.changepass'); //user change password

            Route::get('/cart',Livewire\front\CartComponent::class)->name('product.cart');               //cart
            Route::get('/wishlist',Livewire\front\WishlistComponent::class)->name('product.wishlist');   //wishlist
            Route::get('/checkout',Livewire\front\Checkout::class)->name('checkout');                    //checkout

           // Route::GET('/product_ratings/{id}',[RatingsController::class,'storeProductRating']);

            /************************* Start Product & Farmer Rating ******************************/
            Route::get('/user/ratings/product/{id}/{rate}', [RatingsController::class, 'storeProductRating'])->name('storeProductRating');
            Route::get('/user/ratings/farmer/{id}/{rate}', [RatingsController::class, 'storeFarmerRating'])->name('storeFarmerRating');
            /************************* End Product & Farmer Rating ******************************/


            /********************************* End Admin & Employee Routes ************************************/

            /************************* Start Checkout & PaymentMethod ******************************/
            Route::get('/thank-you', ThankYouComponent::class)->name('thankyou');
            /*Route::post('/checkout/payment', [PaymentMethodController::class, 'checkout_now'])->name('checkout.paypal');
            Route::get('/checkout/{order_id}/cancelled', [PaymentMethodController::class, 'cancelled'])->name('checkout.paypal.cancel');
            Route::get('/checkout/{order_id}/completed', [PaymentMethodController::class, 'completed'])->name('checkout.paypal.complete');
            Route::get('/checkout/webhook/{order?}/{env?}', [PaymentMethodController::class, 'webhook'])->name('checkout.paypal.webhook.ipn');*/
            /************************* End Checkout & PaymentMethod ******************************/
        });

        Route::get('/category_products/{id}',[CategoryProductController::class,'showCategoryProduct'])->name('pro_cat');

    require __DIR__.'/auth.php';
    });
















