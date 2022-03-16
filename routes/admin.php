<?php
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\CountryController;
use App\Http\Controllers\Dashboard\Admin\VillageController;
use App\Http\Controllers\Dashboard\Admin\StateController;
use App\Http\Controllers\Dashboard\Admin\AreaController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Admin\FarmerController;
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use App\Http\Controllers\Dashboard\Admin\SettingController;
use App\Http\Controllers\Dashboard\Admin\ProvinceController;

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
            /********************************* Start Admin & Employee Routes ************************************/
            Route::resource('Admins', AdminController::class)->except(['show']);
            Route::get('/Admins/data', [AdminController::class,'data'])->name('admins.data');
            /********************************* End Admin & Employee Routes ************************************/
            /********************************* Start Farmer routes ************************************/
            Route::resource('farmers',FarmerController::class)->except(['show']);
            Route::get('/farmers/data', [FarmerController::class,'data'])->name('farmers.data');
            /********************************* end Farmer routes ************************************/
            /********************************* Start User or vendor Routes ************************************/
            Route::resource('users', UserController::class)->except(['show']);
            Route::get('/users/data', [UserController::class,'data'])->name('users.data');
            /********************************* end User or vendor Routes ************************************/

            /********************************* Start country  Routes ************************************/
            Route::resource('countries', CountryController::class)->except(['show']);
            Route::get('/countries/data', [CountryController::class,'data'])->name('countries.data');
            /********************************* end country  Routes ************************************/

            /********************************* Start provinces  Routes ************************************/
            Route::resource('provinces', ProvinceController::class)->except(['show']);
            Route::get('/provinces/data', [ProvinceController::class,'data'])->name('provinces.data');
            /********************************* end province  Routes ************************************/

            /********************************* Start areas  Routes ************************************/
            Route::resource('areas', AreaController::class)->except(['show']);
            Route::get('/areas/data', [AreaController::class,'data'])->name('areas.data');
            /********************************* end areas  Routes ************************************/

            /********************************* Start states  Routes ************************************/
            Route::resource('states', StateController::class)->except(['show']);
            Route::get('/states/data', [StateController::class,'data'])->name('states.data');
            /********************************* end states  Routes ************************************/

            /********************************* Start village  Routes ************************************/
            Route::resource('villages', VillageController::class)->except(['show']);
            Route::get('/villages/data', [VillageController::class,'data'])->name('villages.data');
            /********************************* end village  Routes ************************************/
            /********************************* Start settings Routes ************************************/
            Route::get('Settings', [SettingController::class, 'index'])->name('settings');
            Route::post('Settings/store', [SettingController::class, 'store'])->name('settings.store');
            /********************************* End settings Pages Routes ************************************/
            /********************************* Start settings Routes ************************************/
            Route::get('settings', [SettingController::class,'setting'])->name('settings');
            Route::post('settings/store', [SettingController::class,'save_setting'])->name('settings.store');
            /*************************** End settings Pages Routes ************************************/
            /********************************* Department Routes ************************************/
            Route::resource('Departments', DepartmentController::class)->except(['show']);
            /********************************* End Department Routes ************************************/

        });

    });
