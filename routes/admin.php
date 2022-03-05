<?php
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Dashboard prifex in RouteServiceProvider
Route::group(['namespace'=>'Dashboard', 'prefix'=>'dashboard_admin', 'middleware' => 'auth:admin'], function() {
    /********************************* Start Admins Dashboard Routes ************************************/
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    /********************************* End Admins Pages Routes ************************************/
});
require __DIR__.'/auth.php';