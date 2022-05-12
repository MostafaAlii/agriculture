<?php
use App\Http\Controllers\Dashboard\Farmer\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\front\farmer\EditProduct;
use App\Http\Controllers\front\farmer\FarmerEditProfile;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']

    ], function(){

                // Dashboard prifex in RouteServiceProvider
        Route::group(['prefix'=>'dashboard_farmer', 'middleware' =>'auth'], function() {
            route::get('/home',Livewire\front\Home2::class)->name('home.farmer');
            /********************************* Start Admins Dashboard Routes ************************************/
            // Route::get('/', [DashboardController::class, 'index'])->name('farmer.dashboard');
            route::get('/product',Livewire\front\Farmer\ProductComponent::class)->name('farmer.product'); //farmer product index
            route::get('/product/add',Livewire\front\Farmer\FarmerAddProductComponent::class)->name('farmer.addproduct'); //farmer add product
            // route::get('/product/edit/{product_id}',Livewire\front\Farmer\FarmerEditProductComponent::class)->name('farmer.editproduct'); //farmer edit product
            route::get('/product/edit/{product_id}',[EditProduct::class,'edit'])->name('farmer.editproduct'); //farmer edit product
            route::put('/product/update',[EditProduct::class,'update'])->name('farmer.updateproduct'); //farmer update product


            /********************************* End Admins Pages Routes ************************************/
            route::get('/farmer/ownprofile',Livewire\front\Farmer\FarmerProfile::class)->name('farmer.ownprofile'); //farmer profile
            // route::get('/farmer/ownprofile/edit',Livewire\front\Farmer\FarmerEditProfileComponent::class)->name('farmer.editownprofile'); //user Edit profile

            route::get('/farmer/ownprofile/edit',[FarmerEditProfile::class,'editProfile'])->name('farmer.ownprofile.edit'); //farmer profile
            route::put('/farmer/ownprofile/update',[FarmerEditProfile::class,'update'])->name('farmer.ownprofile.update'); //farmer profile
            // ajax routes ***********************************
            Route::get('/farmer/getprovince/{country_id}', [FarmerEditProfile::class, 'getProvince']);// route ajax for get country provinces
            Route::get('/farmer/area/{province_id}', [FarmerEditProfile::class, 'getArea']);// route ajax for get province areas
            Route::get('/farmer/state/{area_id}', [FarmerEditProfile::class, 'getState']);// route ajax for get areas states
            Route::get('/farmer/village/{state_id}', [FarmerEditProfile::class, 'getVillage']);// route ajax for get state villages

            route::get('/farmer/changepassword',Livewire\front\Farmer\FarmerChangePassword::class)->name('farmer.changepass'); // farmer change password


            /********************************* End Admin & Employee Routes ************************************/
        });
        require __DIR__.'/auth.php';

    });
