<?php
use App\Http\Controllers\Dashboard\Farmer\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire;
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


// Dashboard prifex in RouteServiceProvider
Route::group(['prefix'=>'dashboard_farmer', 'middleware' =>'auth:farmer'], function() {
    /********************************* Start Admins Dashboard Routes ************************************/
    // Route::get('/', [DashboardController::class, 'index'])->name('farmer.dashboard');
    route::get('/product',Livewire\front\Farmer\Product::class)->name('farmer.product');
    /********************************* End Admins Pages Routes ************************************/
});
require __DIR__.'/auth.php';
