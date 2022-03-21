<?php

use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\CountryController;
use App\Http\Controllers\Dashboard\Admin\VillageController;
use App\Http\Controllers\Dashboard\Admin\StateController;
use App\Http\Controllers\Dashboard\Admin\AreaController;

use App\Http\Livewire;
use App\Http\Controllers\front;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Admin\FarmerController;
use App\Http\Controllers\Dashboard\Admin\SettingController;

use App\Http\Controllers\Dashboard\Admin\ProfileController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Admin\DashboardController;

use App\Http\Controllers\Dashboard\Admin\ProvienceController;


use App\Http\Controllers\Dashboard\Admin\DepartmentController;
use App\Http\Controllers\Dashboard\Admin\SliderController;
use App\Http\Controllers\Dashboard\Admin\BlogController;
use App\Http\Controllers\Dashboard\Admin\TagController;
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
            Route::delete('/admins/bulk_delete/{ids}', [AdminController::class,'bulkDelete'])->name('admins.bulk_delete');
            Route::get('/admin/profile/{id}', [AdminController::class,'showProfile'])->name('admin.profile');
            Route::put('/admin/profileupdate/{id}', [AdminController::class,'updateAccount'])->name('admin.updateAccount'); // update admin form account
            Route::put('/admin/profileupdateinfo/{id}', [AdminController::class,'updateInformation'])->name('admin.updateInformation'); //update admin form information
            // route for auth profile Authadmin *******************************************************************
            Route::resource('profile', ProfileController::class)->except(['show']); // route for dashboard profile Auth admin
            Route::put('/profile/profileupdate/{id}', [ProfileController::class,'updateAccount'])->name('profile.updateAccount'); // update auth form account
            Route::put('/profile/profileupdateinfo/{id}', [ProfileController::class,'updateInformation'])->name('profile.updateInformation'); //update auth form information
            // ajax routes ***********************************
            Route::get('/admin/province/{country_id}', [ProfileController::class, 'getProvince']);// route ajax for get country provinces
            Route::get('/admin/area/{province_id}', [ProfileController::class, 'getArea']);// route ajax for get province areas
            /********************************* End Admin & Employee Routes ************************************/
            /********************************* Start Farmer routes ************************************/
            Route::resource('farmers',FarmerController::class)->except(['show']);
            Route::get('/farmers/data', [FarmerController::class,'data'])->name('farmers.data');
            Route::delete('/farmers/bulk_delete/{ids}', [FarmerController::class,'bulkDelete'])->name('farmers.bulk_delete');
            Route::get('/farmer/profile/{id}', [FarmerController::class,'showProfile'])->name('farmer.profile');
            Route::put('/farmer/profileupdate/{id}', [FarmerController::class,'updateAccount'])->name('farmer.updateAccount'); // update farmer form account
            Route::put('/farmer/profileupdateinfo/{id}', [FarmerController::class,'updateInformation'])->name('farmer.updateInformation'); //update farmer form information
            /********************************* end Farmer routes ************************************/
            /********************************* Start User or vendor Routes ************************************/
            Route::resource('users', UserController::class)->except(['show']);
            Route::get('/users/data', [UserController::class,'data'])->name('users.data');
            Route::delete('/users/bulk_delete/{ids}', [UserController::class,'bulkDelete'])->name('users.bulk_delete');
            Route::get('/user/profile/{id}', [UserController::class,'showProfile'])->name('user.profile');
            Route::put('/user/profileupdate/{id}', [UserController::class,'updateAccount'])->name('user.updateAccount'); // update user form account
            Route::put('/user/profileupdateinfo/{id}', [UserController::class,'updateInformation'])->name('user.updateInformation'); //update user form information
            /********************************* end User or vendor Routes ************************************/


            /********************************* Areas Routes ************************************/
            Route::resource('Areas', AreaController::class)->except(['show']);

            Route::get('/Areas/data', [AreaController::class,'data'])->name('areas.data');
            Route::delete('/Areas/bulk_delete/{ids}', [AreaController::class,'bulkDelete'])->name('areas.bulk_delete');
            /********************************* End Areas Routes ************************************/


            /********************************* Start states  Routes ************************************/

            Route::resource('States', StateController::class)->except(['show']);
            Route::get('/States/data', [StateController::class,'data'])->name('states.data');
            Route::delete('/States/bulk_delete/{ids}', [FarmerController::class,'bulkDelete'])->name('states.bulk_delete');
            /********************************* end states  Routes ************************************/


            /********************************* Start settings Routes ************************************/
            Route::get('Settings', [SettingController::class, 'index'])->name('settings');
            Route::post('Settings/store', [SettingController::class, 'store'])->name('settings.store');
            /********************************* End settings Pages Routes ************************************/
            /********************************* Countries Routes ************************************/
            Route::resource('Countries', CountryController::class)->except(['show']);
            Route::get('/Countries/data', [CountryController::class,'data'])->name('countries.data');
            Route::delete('/Countries/bulk_delete/{ids}', [CountryController::class,'bulkDelete'])->name('countries.bulk_delete');
            /********************************* End Countries Routes ************************************/
            /********************************* Proviences Routes ************************************/
            Route::resource('Proviences', ProvienceController::class)->except(['show']);
            Route::get('/Proviences/data', [ProvienceController::class,'data'])->name('proviences.data');
            Route::delete('/Proviences/bulk_delete/{ids}', [ProvienceController::class,'bulkDelete'])->name('proviences.bulk_delete');
            /********************************* End Proviences Routes ************************************/

            /********************************* States Routes ************************************/
            Route::resource('States', StateController::class)->except(['show']);
            Route::get('/States/data', [StateController::class,'data'])->name('states.data');
            Route::delete('/States/bulk_delete/{ids}', [FarmerController::class,'bulkDelete'])->name('states.bulk_delete');
            /********************************* End States Routes ************************************/
            /********************************* Villages Routes ************************************/
            Route::resource('Villages', VillageController::class)->except(['show']);
            Route::get('/Villages/data', [VillageController::class,'data'])->name('villages.data');
            Route::delete('/Villages/bulk_delete/{ids}', [FarmerController::class,'bulkDelete'])->name('villages.bulk_delete');
            /********************************* End Villages Routes ************************************/
            /********************************* Department Routes ************************************/
            Route::resource('Departments', DepartmentController::class)->except(['show']);
            Route::get('/Departments/data', [DepartmentController::class,'data'])->name('departments.data');
            Route::delete('/Departments/bulk_delete/{ids}', [DepartmentController::class,'bulkDelete'])->name('departments.bulk_delete');
            /********************************* End Department Routes ************************************/
            /********************************* Department Routes ************************************/
            Route::group(['prefix' => 'Sliders'], function () {
                Route::get('/', [SliderController::class, 'addImages'])->name('sliders.create');
                Route::post('sliders', [SliderController::class, 'saveSliderImages'])->name('sliders.store');
                Route::post('sliders/db', [SliderController::class, 'saveSliderImagesDB'])->name('sliders.store.db');
            });
            /********************************* End Department Routes ************************************/
            /********************************* Blog Routes ************************************/
            Route::resource('blogs', BlogController::class)->except(['show']);
            Route::get('/blogs/data', [BlogController::class,'data'])->name('blogs.data');
            Route::delete('/blogs/bulk_delete/{ids}', [BlogController::class,'bulkDelete'])->name('blogs.bulk_delete');
            /********************************* End Blog Routes ************************************/
            /********************************* Tags Routes ************************************/
            Route::resource('tags', TagController::class)->except(['show']);
            Route::get('/tags/data', [TagController::class,'data'])->name('tags.data');
            Route::delete('/tags/bulk_delete/{ids}', [TagController::class,'bulkDelete'])->name('tags.bulk_delete');
            /********************************* End Tags Routes ************************************/
        });

    });
