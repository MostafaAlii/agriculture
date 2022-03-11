<?php
use App\Http\Controllers\Dashboard\Farmer\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
            route::get('/home',Livewire\front\Home::class)->name('home.farmer');
            /********************************* Start Admins Dashboard Routes ************************************/
            // Route::get('/', [DashboardController::class, 'index'])->name('farmer.dashboard');
            route::get('/product',Livewire\front\Farmer\Product::class)->name('farmer.product');
            /********************************* End Admins Pages Routes ************************************/
        });
        require __DIR__.'/auth.php';

    });
