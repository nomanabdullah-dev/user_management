<?php

use App\Http\Controllers\Accounts\UserAccountsController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('users')->name('users.')->middleware(['web', 'auth'])->group(function(){
    Route::get('/', [UsersController::class, 'index'])->name('dashboard');
});
Route::prefix('accounts')->name('accounts.')->middleware(['web', 'auth'])->group(function(){
    Route::get('/', [UserAccountsController::class, 'index'])->name('dashboard');
});

Route::prefix('data')->middleware(['web', 'auth'])->group(base_path('routes/web/data.php'));
