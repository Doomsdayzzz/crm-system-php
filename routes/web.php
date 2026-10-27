<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::middleware('auth.admin')->resource('users', UserController::class)->except(['show']);
Route::resource('applications', ApplicationController::class);

//Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::prefix('auth')->group(function () {
    Auth::routes();
});

