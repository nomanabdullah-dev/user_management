<?php

use App\Http\Controllers\Data\Users\UsersController as UsersUsersController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;


Route::prefix('users')->group(function(){
    Route::get('/', [UsersUsersController::class, 'index']);
});

?>
