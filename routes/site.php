<?php
use App\Http\Livewire;
use App\Http\Controllers\front;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\CommentsController;
use App\Http\Controllers\front\SearchBlogController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\front\RatingsController;
use App\Http\Controllers\front\PaymentController;
use App\Http\Controllers\front\PaymentMethodController;
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

        //--------------------------------search with tag-------------------------------------------------------
        Route::get('/blogs.search/{blog_id}/{type}',[SearchBlogController::class,'search'])->name('blogs.search'); // blog details
        Route::get('/blogs.search2/{text}',[SearchBlogController::class,'search2'])->name('blogs.search2'); // blog details

        //------------------------------------------ start blogs & products comments----------------------------------------
        Route::post('/blogs/{blog}/comments', [CommentsController::class, 'store_blog']);//add &replay (blog)
        Route::post('/products/{product}/comments', [CommentsController::class, 'store_product']);//add &replay (product)
        Route::delete('/comments/{comment}', [CommentsController::class, 'destroy']); // url: /comments/1
        //------------------------------------------ end blogs & products comments----------------------------------------


        route::get('/contactUs',Livewire\front\ContactUs::class)->name('contact');             // contact us
        Route::get('/search',Livewire\front\SearchComponent::class)->name('product.search');  //search



        Route::middleware(['auth:vendor'])->group(function () {
            /********************************* Start  front pages with login by user auth Routes ************************************/
            route::get('/home',Livewire\front\Home2::class)->name('home.user');
            /********************************* End front pages with login by user auth Routes ************************************/
            route::get('/user/dashboard',Livewire\front\User\dashboard::class)->name('user.dash');          //user dash
            route::get('/user/ownprofile',Livewire\front\User\UserProfile::class)->name('user.ownprofile'); //user profile
            route::get('/user/ownprofile/edit',Livewire\front\User\UserEditProfileComponent::class)->name('user.editownprofile'); //user Edit profile
            route::get('/user/changepassword',Livewire\front\User\UserChangePassword::class)->name('user.changepass'); //user change password

            Route::get('/cart',Livewire\front\CartComponent::class)->name('product.cart');               //cart
            Route::get('/wishlist',Livewire\front\WishlistComponent::class)->name('product.wishlist');   //wishlist
            Route::get('/checkout',Livewire\front\Checkout::class)->name('checkout');                    //checkout


            /************************* Start Product & Farmer Rating ******************************/
            Route::post('/user/ratings/product', [RatingsController::class, 'storeProductRating'])->name('storeProductRating');
            Route::post('/user/ratings/farmer', [RatingsController::class, 'storeFarmerRating'])->name('storeFarmerRating');
            /************************* End Product & Farmer Rating ******************************/

            // ajax routes ***********************************
            Route::get('/user/province/{country_id}', [ProfileController::class, 'getProvince']);// route ajax for get country provinces
            Route::get('/user/area/{province_id}', [ProfileController::class, 'getArea']);// route ajax for get province areas
            Route::get('/user/state/{area_id}', [ProfileController::class, 'getState']);// route ajax for get areas states
            Route::get('/user/village/{state_id}', [ProfileController::class, 'getVillage']);// route ajax for get state villages
            /********************************* End Admin & Employee Routes ************************************/
            
            /************************* Start Checkout & PaymentMethod ******************************/
            Route::post('/checkout/payment', [PaymentMethodController::class, 'checkout'])->name('checkout.paypal');
            /************************* End Checkout & PaymentMethod ******************************/
        });


    require __DIR__.'/auth.php';
    });
















