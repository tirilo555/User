<?php

use \Modules\User\Http\Middleware\GuestMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('auth')->group(function() {
    // Login
    Route::get('login', [AuthController::class, 'showLogin'])
        ->name('show-login')
        ->middleware(GuestMiddleware::class);
    Route::post('login', [AuthController::class, 'logIn'])
        ->name('login');
    // Register
    if (config('modules.user.config.allow_user_registration', true)) {
        Route::get('register', [AuthController::class, 'showRegister'])
            ->name('show-register')
            ->middleware(GuestMiddleware::class);
        Route::post('register', [AuthController::class, 'register'])
            ->name('register')
            ->middleware(GuestMiddleware::class);

    }
    // Account Activation
    Route::get('activate/{userId}/{activationCode}', [AuthController::class, 'activate'])
        ->name('activate');

    // Reset password
    Route::get('reset', [AuthController::class, 'showReset'])
        ->name('show-reset');
    Route::post('reset', [AuthController::class, 'reset'])
        ->name('reset');
    Route::get('reset/{id}/{code}', [AuthController::class, 'showResetComplete'])
        ->name('show-reset-complete');
    Route::post('reset/{id}/{code}', [AuthController::class, 'resetComplete'])
        ->name('reset-complete');
    // Logout
    Route::get('logout', [AuthController::class, 'logout'])
        ->name('show-reset-complete');
});
