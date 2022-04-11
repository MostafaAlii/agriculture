<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\UserAuthenticatedSessionController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\RegisteredFarmerController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\FarmerNewPasswordController;
use App\Http\Controllers\Auth\AdminNewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\FarmerPasswordResetLinkController;
use App\Http\Controllers\Auth\AdminPasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    route::view('userlogin','front.user.auth.userlogin')->name('user.login2');       // user login
    route::view('farmerlogin','front.user.auth.farmerlogin')->name('farmer.login');  // farmer login
    // routes for admin login  ***********************************************************************************
    Route::get('agro', [AdminController::class, 'create'])->name('admin.login');    // admin login
    Route::post('Admin/login', [AdminController::class, 'store'])->name('admin.login.post');
    // end routes for admin login ********************************************************************************


    // route for user login *****************************
    Route::get('User/login', [UserAuthenticatedSessionController::class, 'create'])->name('user.login');
    Route::post('User/login', [UserAuthenticatedSessionController::class, 'store'])->name('User.login');
    Route::post('/user-register', [RegisteredUserController::class, 'store'])->name('user.register.post');
    // end route for user login ****************************
    // route for register farmer *********************************************************************************
    Route::post('Farmer/login', [AuthenticatedSessionController::class, 'store'])->name('farmer.login.post');
    Route::post('/farmer-register', [RegisteredFarmerController::class, 'store'])->name('farmer.register.post');
    // end route for register farmer *********************************************************************************

    // user forget password ********************************************************************
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'submitForgetPasswordForm'])
    ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'submitResetPasswordForm'])
    ->name('password.update');
    // user forget password ********************************************************************
    // farmer forget password ********************************************************************
    Route::get('farmer-forgot-password', [FarmerPasswordResetLinkController::class, 'create'])
    ->name('farmer.password.request');

    Route::post('farmer-forgot-password', [FarmerPasswordResetLinkController::class, 'submitForgetPasswordForm'])
    ->name('farmer.password.email');

    Route::get('farmer-reset-password/{token}', [FarmerNewPasswordController::class, 'create'])
    ->name('farmer.password.reset');

    Route::post('farmer-reset-password', [FarmerNewPasswordController::class, 'submitResetPasswordForm'])
    ->name('farmer.password.update');
    // farmer forget password ********************************************************************
    //Admin forget password ********************************************************************
    Route::get('admin-forgot-password', [AdminPasswordResetLinkController::class, 'create'])
    ->name('admin.password.request');

    Route::post('admin-forgot-password', [AdminPasswordResetLinkController::class, 'submitForgetPasswordForm'])
    ->name('admin.password.email');

    Route::get('admin-reset-password/{token}', [AdminNewPasswordController::class, 'create'])
    ->name('admin.password.reset');

    Route::post('admin-reset-password', [AdminNewPasswordController::class, 'submitResetPasswordForm'])
    ->name('admin.password.update');
    // Admin forget password ********************************************************************


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

