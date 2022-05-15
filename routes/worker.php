<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Worker\DashboardController;
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
    });
    require __DIR__.'/auth.php';

});
