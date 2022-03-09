<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\UserAuthenticatedSessionController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // routes for admin login  ***********************************************************************************
    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    
        ], function(){
            Route::get('agro', [AdminController::class, 'create'])->name('admin.login');
            Route::post('Admin/login', [AdminController::class, 'store'])->name('admin.login.post');
        });
    // end routes for admin login ********************************************************************************

    Route::post('Farmer/login', [AuthenticatedSessionController::class, 'store'])->name('farmer.login.post');

    // route for user login *****************************
    Route::get('User/login', [UserAuthenticatedSessionController::class, 'create'])->name('user.login');
    Route::post('User/login', [UserAuthenticatedSessionController::class, 'store'])->name('User.login');
    // Route::get('/user-register', [RegisteredUserController::class, 'create'])->name('user.register');
    Route::post('/user-register', [RegisteredUserController::class, 'store'])->name('user.register.post');
   // end route for user login ****************************

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');


});


Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');


});

// user or vendor log out route *******************************************************************
Route::post('logout/user', [UserAuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:vendor')
    ->name('logout.user');



//  admin log out route *************************************************************************
    Route::post('logout/admin', [AdminController::class, 'destroy'])
    ->middleware('auth:admin')
    ->name('logout.admin');

