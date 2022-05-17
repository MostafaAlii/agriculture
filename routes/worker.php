<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Worker\DashboardController;
use App\Http\Controllers\front\worker\WorkerEditProfile;
use App\Http\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('/xx', function () {
//     return 'xx';
// });
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']

    ], function(){

        Route::middleware(['auth:worker'])->group(function () {
            route::get('/home',Livewire\front\Home2::class)->name('home.worker');
            route::get('/worker/changepassword',Livewire\front\Worker\WorkerChangePassword::class)->name('worker.changepass'); // worker change password

             route::get('/worker/ownprofile',Livewire\front\Worker\WorkerProfile::class)->name('worker.ownprofile'); //worker profile
             route::get('/worker/ownprofile/edit',[WorkerEditProfile::class,'editProfile'])->name('worker.ownprofile.edit'); //edit worker profile
             route::put('/worker/ownprofile/update',[WorkerEditProfile::class,'update'])->name('worker.ownprofile.update'); //update worker profile

                  // ajax routes ***********************************
            Route::get('/worker/getprovince/{country_id}', [WorkerEditProfile::class, 'getProvince']);// route ajax for get country provinces
            Route::get('/worker/area/{province_id}', [WorkerEditProfile::class, 'getArea']);// route ajax for get province areas
            Route::get('/worker/state/{area_id}', [WorkerEditProfile::class, 'getState']);// route ajax for get areas states
            Route::get('/worker/village/{state_id}', [WorkerEditProfile::class, 'getVillage']);// route ajax for get state villages

    });
    require __DIR__.'/auth.php';

});
