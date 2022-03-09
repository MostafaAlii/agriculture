<?php
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\SettingController;
use App\Http\Controllers\front;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//Route::get('/', function () {
//    return view('welcome');
//});
// Dashboard prifex in RouteServiceProvider
//Route::group(['namespace'=>'Dashboard', 'prefix'=>'dashboard_admin', 'middleware' => 'auth:admin'], function() {
//    /********************************* Start Admins Dashboard Routes ************************************/

//    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard1');


Route::get('/home/admin',[front\HomeController::class,'index'])->name('home.admin')->middleware('auth:admin'); // route for admin to go to website
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:admin']

    ], function(){

        Route::group(['namespace'=>'Dashboard\Admin', 'prefix'=>'dashboard_admin'], function() {
        /********************************* Start Admins Dashboard Routes ************************************/
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    /********************************* End Admins Pages Routes ************************************/

    /********************************* Start settings Routes ************************************/
    Route::get('settings', [SettingController::class,'index'])->name('settings');
    Route::post('settings/store', [SettingController::class,'store'])->name('settings.store');
    /********************************* End settings Pages Routes ************************************/
            require __DIR__.'/auth.php';
        });
});
