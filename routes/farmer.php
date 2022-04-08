<?php
use App\Http\Controllers\Dashboard\Farmer\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
/*
|--------------------------------------------------------------------------
| Farmer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






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
            route::get('/product',Livewire\front\Farmer\ProductComponent::class)->name('farmer.product');
            route::get('/product/add',Livewire\front\Farmer\FarmerAddProductComponent::class)->name('farmer.addproduct');
            /********************************* End Admins Pages Routes ************************************/
            route::get('/farmer/ownprofile',Livewire\front\Farmer\FarmerProfile::class)->name('farmer.ownprofile'); //farmer profile
            route::get('/farmer/ownprofile/edit',Livewire\front\Farmer\FarmerEditProfileComponent::class)->name('farmer.editownprofile'); //user Edit profile
            route::get('/farmer/changepassword',Livewire\front\Farmer\FarmerChangePassword::class)->name('farmer.changepass'); // farmer cahnge password

            // ajax routes ***********************************
            Route::get('/farmer/province/{country_id}', [ProfileController::class, 'getProvince']);// route ajax for get country provinces
            Route::get('/farmer/area/{province_id}', [ProfileController::class, 'getArea']);// route ajax for get province areas
            Route::get('/farmer/state/{area_id}', [ProfileController::class, 'getState']);// route ajax for get areas states
            Route::get('/farmer/village/{state_id}', [ProfileController::class, 'getVillage']);// route ajax for get state villages
            /********************************* End Admin & Employee Routes ************************************/
        });
        require __DIR__.'/auth.php';

    });
