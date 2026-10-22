<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::name('api')->resource('users', UserController::class)->except(['create', 'edit'])
//->middleware('auth.admin')
;
