<?php
use App\Http\Controllers\Dashboard\Farmer\DashboardController;
use Illuminate\Support\Facades\Route;
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
Route::group(['namespace'=>'Dashboard', 'prefix'=>'dashboard_farmer', 'middleware' => 'auth'], function() {
    /********************************* Start Admins Dashboard Routes ************************************/
    Route::get('/', [DashboardController::class, 'index'])->name('farmer.dashboard');
    /********************************* End Admins Pages Routes ************************************/
});
require __DIR__.'/auth.php';