<?php
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Admin\FarmerController;
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use App\Http\Controllers\Dashboard\Admin\SettingController;
use App\Http\Controllers\front;
use App\Http\Livewire;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Admin\DepartmentController;
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


require __DIR__ . '/auth.php';

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin'],

    ], function () {
        route::get('/home/admin', Livewire\front\Home::class)->name('home.admin');
        // route for admin to go to website

        Route::group(['prefix' => 'dashboard_admin'], function () {
            /********************************* Start Admins Dashboard Routes ************************************/
            Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
            /********************************* End Admins Pages Routes ************************************/

            /********************************* Start settings Routes ************************************/
            Route::get('Settings', [SettingController::class, 'index'])->name('settings');
            Route::post('Settings/store', [SettingController::class, 'store'])->name('settings.store');
            /********************************* End settings Pages Routes ************************************/

            /********************************* Start Admin & Employee Routes ************************************/
            Route::resource('Admins', AdminController::class)->except(['show']);
            /********************************* End Admin & Employee Routes ************************************/


            /********************************* Department Routes ************************************/
            Route::resource('Departments', DepartmentController::class)->except(['show']);
            /********************************* End Department Routes ************************************/

            /********************************* Start Farmer routes ************************************/
            Route::resource('farmers',FarmerController::class)->except(['show']);
            /********************************* end Farmer routes ************************************/
            /********************************* Start User or vendor Routes ************************************/
            Route::resource('users', UserController::class)->except(['show']);
            /********************************* end User or vendor Routes ************************************/

        });

    });
