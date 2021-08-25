<?php

use App\Http\Controllers\Accounts\updates\EmailUpdatesController;
use App\Http\Controllers\Accounts\updates\NameUpdatesController;
use App\Http\Controllers\Accounts\UserAccountController;
use App\Http\Controllers\Accounts\UserAccountsController;
use App\Http\Controllers\Data\Users\Logs\UserLogsController;
use App\Http\Controllers\Data\Users\Updates\UpdatePasswordsController;
use App\Http\Controllers\Data\Users\UsersController as UsersUsersController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('accounts')->group(function(){
    Route::get('user/{user?}', [UserAccountController::class, 'index']);
    Route::prefix('updates')->group(function(){
        Route::put('email/{user?}', [EmailUpdatesController::class, 'update']);
        Route::put('name/{user?}', [NameUpdatesController::class, 'update']);
    });
});

Route::prefix('users')->group(function(){
    Route::prefix('logs')->group(function(){
        Route::get('{user}', [UserLogsController::class, 'index']);
    });

    Route::prefix('updates')->group(function(){
        Route::put('password/{user}', [UpdatePasswordsController::class, 'update']);
        Route::post('send-reset-link/{user}', [UpdatePasswordsController::class, 'sendResetLink']);
    });


    Route::get('/', [UsersUsersController::class, 'index']);
    Route::post('/', [UsersUsersController::class, 'store']);
    Route::put('{user}', [UsersUsersController::class, 'update']);
    Route::delete('{user}', [UsersUsersController::class, 'destroy']);
});

?>
