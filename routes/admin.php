<?php
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\SettingController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\front;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Livewire;
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
//Route::get('/home/admin',[front\HomeController::class,'index'])->name('home.admin')->middleware('auth:admin'); // route for admin to go to website


//Route::get('/', function () {
//    return view('welcome');
//});
// Dashboard prifex in RouteServiceProvider
//Route::group(['namespace'=>'Dashboard', 'prefix'=>'dashboard_admin', 'middleware' => 'auth:admin'], function() {
//    /********************************* Start Admins Dashboard Routes ************************************/

//    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard1');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth:admin']

    ], function(){
        Route::get('/home/admin',[front\HomeController::class,'index'])->name('home.admin');
        Route::group([ 'prefix'=>'dashboard_admin'], function() {


        route::get('/home/admin',Livewire\front\Home::class)->name('home.admin'); // route for admin to go to website

        Route::group(['namespace'=>'Dashboard\Admin', 'prefix'=>'dashboard_admin'], function() {
        /********************************* Start Admins Dashboard Routes ************************************/
        //Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    /********************************* End Admins Pages Routes ************************************/

    /********************************* Start settings Routes ************************************/
    Route::get('Settings', [SettingController::class,'index'])->name('settings');
    Route::post('Settings/store', [SettingController::class,'store'])->name('settings.store');
    /********************************* End settings Pages Routes ************************************/

    /********************************* Start Admin & Employee Routes ************************************/
    Route::resource('Admins', AdminController::class)->except(['show']);
    /********************************* End Admin & Employee Routes ************************************/
        require __DIR__.'/auth.php';
    });
});
            require __DIR__.'/auth.php';
        });
});
