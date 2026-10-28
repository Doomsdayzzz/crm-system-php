<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try {
        throw new \Symfony\Component\Finder\Exception\AccessDeniedException('не прав!');
    }catch (\Exception $exception){
        Log::critical($exception->getMessage(), $exception->getTrace());
    }


    return view('dashboard');
});

Route::middleware('auth.admin')->resource('users', UserController::class)->except(['show']);
Route::resource('applications', ApplicationController::class);

// Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::prefix('auth')->group(function () {
    Auth::routes();
});
